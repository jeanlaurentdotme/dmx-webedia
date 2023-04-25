#pragma once

#include <QtWidgets/QMainWindow>
#include "ui_QtWidgetsApplication3.h"
#include <QSerialPortInfo>
#include <QSerialPort>

class QtWidgetsApplication3 : public QMainWindow
{
    Q_OBJECT

public:
    QtWidgetsApplication3(QWidget *parent = Q_NULLPTR);

private:
    Ui::QtWidgetsApplication3Class ui;
    QSerialPort *serialPort = new QSerialPort();
    int potentiometre1;
    QString buffer;
    bool sendCheckbox;

public slots:
    //void potValuesCheckBoxChecked();
    //void sendCheckboxData();
    void requete();
    void Lirevaleur();
};
