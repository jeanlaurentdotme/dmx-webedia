#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <iostream>
#include <qdebug.h>
#include <QtSql/QtSql>
#include <QtGui>
#include <QCoreApplication>
#include <QtWidgets/QMainWindow>


QVariant variant;
QString string = variant.toString();
//puis en std string
std::string str = string.toStdString();


#define q2c(string) string.toStdString()


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

 /*   if(db.open())
       {
           qDebug() << "Connexion réussie à " << db.hostName();
       }
       else
       {
           qDebug() << "La connexion a échouée !";

       }
*/
/*    QSqlQuery query;
    if(query.exec("SELECT nom FROM SceneTest"))
    {
        while(query.next())
        {
            qDebug() << "    Nouvelle entrée";
            for(int x=0; x < query.record().count(); ++x)
            {

                std::cout << q2c(query.record().fieldName(x)) << " = " << q2c(query.value(x).toString() ) << std::endl;
            }
        }
    }*/
}
MainWindow::~MainWindow()
{
    delete ui;
}

void MainWindow::SeConnecter()
{
    if(db.open())
       {
           qDebug() << "Connexion réussie à " << db.hostName();
           ui->label->setText("Vous vous êtes bien connecté à la BDD");
       }
       else
       {
           qDebug() << "La connexion a échouée !";

       }
}
