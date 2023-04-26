//Les includes permettant l'accés à certaines fonctions utiles
#include "mainwindow.h"
#include "modification.h"
#include "ui_mainwindow.h"
#include <iostream>
#include <qdebug.h>
#include <QtSql/QtSql>
#include <QtGui>
#include <QCoreApplication>
#include <QtWidgets/QMainWindow>
#include <QLineEdit>
#include <qlineedit.h>
#include <QList>
#include <QString>


//on associe q2c à un string.toStdString() pour écrire / tester plus facilement
#define q2c(string) string.toStdString()


MainWindow::MainWindow(QWidget *parent)
: QMainWindow(parent),
ui(new Ui::MainWindow)
{
ui->setupUi(this);

db = QSqlDatabase::addDatabase("QMYSQL");

db.setHostName("192.168.64.144");
db.setUserName("root");
db.setPassword("root");
db.setDatabaseName("PROJETWEBEDIA");
}
