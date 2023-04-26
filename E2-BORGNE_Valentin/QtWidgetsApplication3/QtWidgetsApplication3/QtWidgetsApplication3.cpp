#include "QtWidgetsApplication3.h"
#include <QSerialPortInfo>
#include <QSerialPort>
#include <QJsonDocument>
#include <qjsonobject.h>
#include <qjsonvalue.h>
#include <QString>
#include <QDebug>

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

/*void QtWidgetsApplication3::potValuesCheckBoxChecked()
{
    if (sendCheckbox)
    {
        QByteArray data;
        if (ui.checkBox->isChecked())
        {
            
        }
        else
        {

        }
        serialPort->write(data);
    }
}*/

void QtWidgetsApplication3::requete()
{
    serialPort->write("1");
}

void QtWidgetsApplication3::Lirevaleur()
{
//    for (int i = 0; i <= 20; i++)
//    {
        QByteArray data = serialPort->read(serialPort->bytesAvailable());
        QString datastring(data);
        ui.textEdit->insertPlainText(datastring);
        serialPort->clear();
        serialPort->write("1");
//    }
}