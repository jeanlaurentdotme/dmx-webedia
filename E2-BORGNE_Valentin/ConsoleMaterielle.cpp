#include "ConsoleMaterielle.h"
#include <qjsondocument.h>
#include <qjsonobject.h>

#include <termios.h>

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
    serialPort = new QSerialPort(this);
    qDebug() << "Test";
    potentiometre1 = 0;
    serialPort->setPortName("/dev/ttyACM0"); // Remplacez COM1 par le nom du port serie que vous voulez ouvrir
    serialPort->setBaudRate(QSerialPort::Baud9600); // Definir le debit en bauds
    serialPort->setDataBits(QSerialPort::Data8); // Definir le nombre de bits de donnees
    serialPort->setParity(QSerialPort::NoParity); // Definir le type de parite
    serialPort->setStopBits(QSerialPort::OneStop); // Definir le nombre de bits de stop
    serialPort->setFlowControl(QSerialPort::NoFlowControl); // Definir le controle de flux
    QObject::connect(serialPort, &QSerialPort::readyRead, this, &ConsoleMaterielle::onReadyRead);

    if (serialPort->open(QIODevice::ReadWrite)) {
        // Le port serie est ouvert avec succes
        qDebug() << "Init serialport done";
        init = true;
        QObject::connect(&timer, &QTimer::timeout, this, &ConsoleMaterielle::requete);
        timer.start(100);//50

        QObject::connect(&sendTimer, &QTimer::timeout, this, &ConsoleMaterielle::sendQueuedMessages);
        sendTimer.start(30);//15
    }
    else {
        // Echec de l'ouverture du port serie
        init = false;
        qDebug() << "Init serialport failed";
    }
}

void ConsoleMaterielle::setScene(QString sceneName)
{
    QString str = "2;" + sceneName + "\n";
    messageQueue.push_back(str);
}

void ConsoleMaterielle::onReadyRead()
{
    while(serialPort->canReadLine())
    {
        QByteArray data = serialPort->readLine();
        QString datastring(data);

        if (datastring.length() > 0)
        {
            QString line = datastring;
            if (line.endsWith("}\r\n"))
            {
                int idx = line.lastIndexOf("{");
                line.remove(0, idx);
                QJsonDocument jsonData = QJsonDocument::fromJson(line.toUtf8());
                QJsonObject json = jsonData.object();
                if (json.contains("type") && json["type"].isString())
                {
                    qDebug() << "Data received : " << line;
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
                        if (json.contains("b2"))
                        {
                            QJsonValue b1Obj = json.value("b2");
                            int val = b1Obj.toInt(-1);
                            if (val >= 0)
                            {
                                emit buttonPushed(2, val);
                            }
                        }
                        if (json.contains("b3"))
                        {
                            QJsonValue b1Obj = json.value("b3");
                            int val = b1Obj.toInt(-1);
                            if (val >= 0)
                            {
                                emit buttonPushed(3, val);
                            }
                        }
                    }
                    else if(type == "ackScene")
                    {
                        if (json.contains("value"))
                        {
                            QJsonValue b1Obj = json.value("value");
                            QString val = b1Obj.toString();
                            qDebug() << "Arduino value ack : " << val;
                        }

                    }
                    else if(type == "default")
                    {
                        if (json.contains("value"))
                        {
                            QJsonValue b1Obj = json.value("value");
                            QString val = b1Obj.toString();
                            qDebug() << "Arduino value default : " << val;
                        }

                    }
                }
            }
        }

    }
}

void ConsoleMaterielle::sendQueuedMessages()
{
    while(messageQueue.size() > 0){
        serialPort->write(messageQueue[0].toStdString().c_str());
        serialPort->flush();
        //qDebug() << "write called" << messageQueue[0];

        //int serialHandle = serialPort->handle();
        //tcdrain(serialHandle);

        messageQueue.pop_front();
    }

}
