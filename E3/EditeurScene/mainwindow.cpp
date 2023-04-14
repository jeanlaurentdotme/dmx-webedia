#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <iostream>
#include <qdebug.h>

MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::MainWindow)
{
    ui->setupUi(this);

    db = QSqlDatabase::addDatabase("QMYSQL");

    db.setHostName("192.168.64.144");
    db.setUserName("root");
    db.setPassword("root");
    db.setDatabaseName("PROJETWEBEDIA");

    if(db.open())
       {
           qDebug() << "Connexion réussie à " << db.hostName();
       }
       else
       {
           qDebug() << "La connexion a échouée !";

       }
}

MainWindow::~MainWindow()
{
    delete ui;
}

