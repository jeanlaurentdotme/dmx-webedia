#include "QtWidgetsApplication2.h"
#include <QSerialPortInfo>
#include <QList>
#include <QSerialPort>
#include <QDebug>
#include <QMessageBox>
#include <QLineEdit>
#include <QJsonDocument>
#include <qjsonobject.h>
#include <qjsonvalue.h>

QtWidgetsApplication2::QtWidgetsApplication2(QWidget *parent)
    : QMainWindow(parent)
{
    ui.setupUi(this);
    
    QList<QSerialPortInfo> availablePorts = QSerialPortInfo::availablePorts();
    foundPort = false;

    QObject::connect(ui.pushButton_2, SIGNAL(clicked()), this, SLOT(onSendMessageButtonClicked()));

    for (int i = 0; i < availablePorts.size(); i++)
    {
        QSerialPortInfo info = availablePorts[i];
        ui.portComboBox->addItem(info.portName(), QVariant(info.portName()));

        port = new QSerialPort(info.portName());
        QObject::connect(port, SIGNAL(readyRead()), this, SLOT(onSerialPortReadyRead()));
        port->setBaudRate(9600);
        port->setDataBits(QSerialPort::DataBits::Data8);
        port->setParity(QSerialPort::Parity::NoParity);
        port->setStopBits(QSerialPort::StopBits::OneStop);
        if (port->open(QIODevice::OpenModeFlag::ExistingOnly | QIODevice::OpenModeFlag::ReadWrite))
        {
            port->write("check");
            

            port->waitForReadyRead(1000);
            port->write("check");
            
            port->waitForReadyRead(1000);
            if (!foundPort)
            {
                port->close();
                QObject::disconnect(port, SIGNAL(readyRead()), this, SLOT(onSerialPortReadyRead()));
                port->deleteLater();
                port = nullptr;
            }
            else
            {
                ui.portStatusLabel->setText("Status port : Ouvert");
                qDebug() << "Device found on " << info.portName();
                break;
            }
        }

    }
}

void QtWidgetsApplication2::onSendMessageButtonClicked()
{
    if (port->isOpen())
    {
        
        port->write(ui.lineEdit->text().toStdString().c_str());
    }
}

void QtWidgetsApplication2::onSerialPortReadyRead()
{
    QByteArray data = port->read(port->bytesAvailable());
    QString str(data);
    //ui.textEdit->insertPlainText(str);

    buffer += str;

    if (buffer.endsWith("}"))
    {
        int idx = buffer.lastIndexOf("{");
        buffer.remove(0, idx);
        

        QJsonDocument jsonData = QJsonDocument::fromJson(buffer.toUtf8());
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
                       ui.verticalSlider->setValue(val);
                       potentiometre1 = val;
                    }
                 }

                    /*if (json.contains("p2"))
                    {
                        QJsonValue p2Obj = json.value("p2");
                        int val = p2Obj.toInt(-1);

                        if (val >= 0)
                        {
                            ui.verticalSlider_2->setValue(val);
                        }
                    }

                    if (json.contains("p3"))
                    {
                        QJsonValue p3Obj = json.value("p3");
                        int val = p3Obj.toInt(-1);

                        if (val >= 0)
                        {
                            ui.verticalSlider_3->setValue(val);
                        }
                    }*/
            }
            else if (type == "check")
            {
                foundPort = true;
            }
        }
        buffer = "";
        port->write("potValues");
    }
}