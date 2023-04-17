#pragma once

#include <QtWidgets/QMainWindow>
#include "ui_QtWidgetsApplication2.h"
#include <QSerialPort>

class QtWidgetsApplication2 : public QMainWindow
{
    Q_OBJECT

public:
    QtWidgetsApplication2(QWidget *parent = Q_NULLPTR);

private:
    Ui::QtWidgetsApplication2Class ui;
    QSerialPort *port;
    QString buffer;
    int potentiometre1;
    bool foundPort;

public slots:
    void onSendMessageButtonClicked();
    void onSerialPortReadyRead();
};