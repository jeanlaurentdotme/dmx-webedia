#include "ConsoleMaterielle.h"
#include <qjsondocument.h>
#include <qjsonobject.h>

void ConsoleMaterielle::requete()
{
    if (init)
    {
        messageQueue.push_back("1\n");
    }
}

ConsoleMaterielle::ConsoleMaterielle(QObject* parent)
    : QObject(parent)
{
    potentiometre1 = 0;
    serialPort->setPortName("COM7"); // Remplacez COM1 par le nom du port serie que vous voulez ouvrir
    serialPort->setBaudRate(QSerialPort::Baud9600); // Definir le debit en bauds
    serialPort->setDataBits(QSerialPort::Data8); // Definir le nombre de bits de donnees
    serialPort->setParity(QSerialPort::NoParity); // Definir le type de parite
    serialPort->setStopBits(QSerialPort::OneStop); // Definir le nombre de bits de stop
    serialPort->setFlowControl(QSerialPort::NoFlowControl); // Definir le controle de flux
    QObject::connect(serialPort, &QSerialPort::readyRead, this, &ConsoleMaterielle::onReadyRead);

    if (serialPort->open(QIODevice::ReadWrite)) {
        // Le port serie est ouvert avec succes
        init = true;
        QObject::connect(&timer, &QTimer::timeout, this, &ConsoleMaterielle::requete);
        timer.start(25);

        QObject::connect(&sendTimer, &QTimer::timeout, this, &ConsoleMaterielle::sendQueuedMessages);
        sendTimer.start(15);
    }
    else {
        // Echec de l'ouverture du port serie
        init = false;
    }
}

void ConsoleMaterielle::setScene(QString sceneName)
{
    QString str = "2;" + sceneName + "\n";
    messageQueue.push_back(str);
}

void ConsoleMaterielle::onReadyRead()
{
    QByteArray data = serialPort->read(serialPort->bytesAvailable());
    QString datastring(data);
    
    if (datastring.length() > 0)
    {
        buffer += datastring;

        QStringList splited = buffer.split(QRegExp("[\r\n]"), QString::KeepEmptyParts);
        QList<int> nonProcessedLines;

        for (int i = 0; i < splited.size(); i++)
        {
            QString line = splited[i];
            if (line.endsWith("}"))
            {
                int idx = line.lastIndexOf("{");
                line.remove(0, idx);
                QJsonDocument jsonData = QJsonDocument::fromJson(line.toUtf8());
                QJsonObject json = jsonData.object();
                if (json.contains("type") && json["type"].isString())
                {
                    QString type = json["type"].toString();
                    if (type == "potValues")
                    {
                        if (json.contains("p1"))
                        {
                            QJsonValue p1Obj = json.value("p1");
                            int val = p1Obj.toInt(-1);
                            if (val >= 0)
                            {
                               
                                potentiometre1 = val;
                                emit potValueChanged(1, val);
                            }
                        }
                    }
                    else if (type == "button")
                    {
                        if (json.contains("b1"))
                        {
                            QJsonValue b1Obj = json.value("b1");
                            int val = b1Obj.toInt(-1);
                            if (val >= 0)
                            {
                                emit buttonPushed(1, val);
                            }
                        }
                    }
                }
            }
            else
                nonProcessedLines.push_back(i);

            buffer = "";

            for (int i = 0; i < nonProcessedLines.size(); i++)
            {
                if (splited[nonProcessedLines[i]].size() > 0)
                {
                    buffer += splited[nonProcessedLines[i]];
                    
                }
            }
        }
    }
}

void ConsoleMaterielle::sendQueuedMessages()
{
    for (int i = 0; i < messageQueue.size(); i++)
    {
        serialPort->write(messageQueue[i].toStdString().c_str());
    }
    messageQueue.clear();
}
