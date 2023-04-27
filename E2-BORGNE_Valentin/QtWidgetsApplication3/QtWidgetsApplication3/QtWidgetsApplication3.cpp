#include "QtWidgetsApplication3.h"
#include <QSerialPortInfo>
#include <QSerialPort>
#include <QJsonDocument>
#include <qjsonobject.h>
#include <qjsonvalue.h>
#include <QString>
#include <QDebug>
#include <QTimer>
#include <QCheckBox>
#include <QJsonDocument>
#include <qjsonobject.h>
#include <qjsonvalue.h>

QtWidgetsApplication3::QtWidgetsApplication3(QWidget *parent)
    : QMainWindow(parent)
{
    ui.setupUi(this);
    serialPort->setPortName("COM7"); // Remplacez COM1 par le nom du port série que vous voulez ouvrir
    serialPort->setBaudRate(QSerialPort::Baud9600); // Définir le débit en bauds
    serialPort->setDataBits(QSerialPort::Data8); // Définir le nombre de bits de données
    serialPort->setParity(QSerialPort::NoParity); // Définir le type de parité
    serialPort->setStopBits(QSerialPort::OneStop); // Définir le nombre de bits de stop
    serialPort->setFlowControl(QSerialPort::NoFlowControl); // Définir le contrôle de flux
    QObject::connect(ui.checkBox, &QCheckBox::stateChanged, this, &QtWidgetsApplication3::potValuesCheckBoxChecked);

    if (serialPort->open(QIODevice::ReadWrite)) {
        // Le port série est ouvert avec succès
        ui.label->setText("Ouvert");
    }
    else {
        // Échec de l'ouverture du port série
        ui.label->setText("Echec");
    }
}

/*void QtWidgetsApplication3::sendCheckboxData()
{
    if (ui.checkBox->isChecked())
    {
        sendCheckbox = true;
    }
    else
    {
        sendCheckbox = false;
    }
}*/

void QtWidgetsApplication3::potValuesCheckBoxChecked(int state)
{
    if (state ==Qt::Checked)
    {
        QObject::connect(&timer, &QTimer::timeout, this, &QtWidgetsApplication3::requete);
        timer.start(2000);
    }
    else
    {
        timer.stop();
        QObject::disconnect(&timer, &QTimer::timeout, this, &QtWidgetsApplication3::requete);
    }
}

void QtWidgetsApplication3::requete()
{
    serialPort->write("1");
    QObject::connect(serialPort, &QSerialPort::readyRead, this, &QtWidgetsApplication3::onReadyRead);
}

void QtWidgetsApplication3::Lirevaleur()
{
    QByteArray data = serialPort->read(serialPort->bytesAvailable());
    QString datastring(data);
    ui.textEdit->insertPlainText(datastring);
    serialPort->clear();
    serialPort->write("1");
}

void QtWidgetsApplication3::onReadyRead()
{
    if (serialPort->waitForReadyRead(100))
    {
        QByteArray data = serialPort->read(serialPort->bytesAvailable());
        QString datastring(data);
        ui.textEdit->insertPlainText(datastring);
        buffer += datastring;
        if (buffer.endsWith("}"))
        {
            int idx = buffer.lastIndexOf("{");
            buffer.remove(0, idx);
            QJsonDocument jsonData = QJsonDocument::fromJson(buffer.toUtf8());
            QJsonObject json = jsonData.object();
            if (json.contains("p1"))
            {
                QJsonValue p1Obj = json.value("p1");
                int val = p1Obj.toInt();
                if (val >= 0)
                {
                    ui.verticalSlider->setValue(val);

                }
            }
            buffer = "";
        }
    }
}