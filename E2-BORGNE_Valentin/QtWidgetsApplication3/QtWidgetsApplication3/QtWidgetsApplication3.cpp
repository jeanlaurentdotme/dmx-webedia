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
    console = new ConsoleMaterielle(this);
    QObject::connect(console, &ConsoleMaterielle::potValueChanged, this, &QtWidgetsApplication3::onPotValueChanged);
    QObject::connect(console, &ConsoleMaterielle::buttonPushed, this, &QtWidgetsApplication3::onButtonPushed);
}

void QtWidgetsApplication3::onButtonPushed(int buttonId, int value)
{
    qDebug() << "Button " << buttonId << " state = " << value;
    QString str = "Button " + QString::number(buttonId) + " " + QString::number(value);
    ui.label->setText(str);
}

void QtWidgetsApplication3::sendText()
{
    console->setScene(ui.lineEdit->text());
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

void QtWidgetsApplication3::onPotValueChanged(int potentiometre, int value)
{
    ui.verticalSlider->setValue(value);

    QByteArray hexVal = QByteArray::number(value, 16);
    qDebug() << hexVal;
}
