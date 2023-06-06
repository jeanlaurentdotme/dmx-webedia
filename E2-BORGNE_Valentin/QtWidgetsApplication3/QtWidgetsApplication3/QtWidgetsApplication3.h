#pragma once

#include <QtWidgets/QMainWindow>
#include "ui_QtWidgetsApplication3.h"
#include <QSerialPortInfo>
#include <QSerialPort>
#include <QTimer>
#include "ConsoleMaterielle.h"

class QtWidgetsApplication3 : public QMainWindow
{
    Q_OBJECT

public:
    QtWidgetsApplication3(QWidget *parent = Q_NULLPTR);

private:
    Ui::QtWidgetsApplication3Class ui;
    ConsoleMaterielle* console;

public slots:
    void onPotValueChanged(int, int);
    void onButtonPushed(int, int);
    void sendText();
};