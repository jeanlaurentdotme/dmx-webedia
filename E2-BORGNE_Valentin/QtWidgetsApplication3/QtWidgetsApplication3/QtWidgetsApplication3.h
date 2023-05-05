#pragma once

#include <QtWidgets/QMainWindow>
#include "ui_QtWidgetsApplication3.h"
#include <QSerialPortInfo>
#include <QSerialPort>
#include <QTimer>

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
    QTimer timer;

public slots:
    void potValuesCheckBoxChecked(int state);
    //void sendCheckboxData();
    void requete();
    void onReadyRead();
    void sendText();
    void buttonClicked();
};