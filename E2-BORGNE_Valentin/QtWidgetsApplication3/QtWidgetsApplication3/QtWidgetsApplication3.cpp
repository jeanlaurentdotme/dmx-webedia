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
    serialPort->setPortName("COM7"); // Remplacez COM1 par le nom du port s�rie que vous voulez ouvrir
    serialPort->setBaudRate(QSerialPort::Baud9600); // D�finir le d�bit en bauds
    serialPort->setDataBits(QSerialPort::Data8); // D�finir le nombre de bits de donn�es
    serialPort->setParity(QSerialPort::NoParity); // D�finir le type de parit�
    serialPort->setStopBits(QSerialPort::OneStop); // D�finir le nombre de bits de stop
    serialPort->setFlowControl(QSerialPort::NoFlowControl); // D�finir le contr�le de flux

    if (serialPort->open(QIODevice::ReadWrite)) {
        // Le port s�rie est ouvert avec succ�s
        ui.label->setText("Ouvert");
    }
    else {
        // �chec de l'ouverture du port s�rie
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