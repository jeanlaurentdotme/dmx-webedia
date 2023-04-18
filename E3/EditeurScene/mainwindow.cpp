#include "mainwindow.h"
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

    if(db.open())
       {
           qDebug() << "Connexion réussie à " << db.hostName();
       }
       else
       {
           qDebug() << "La connexion a échouée !";

       }

/*    QSqlQuery query;
    if(query.exec("INSERT INTO SceneTest(id,nom,couleurscene,L1,L2,L3) VALUES (0,'Testcpp', '#814603', '#814603' , '#814603' , '#814603'"))
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

/*    //ajouter des valeurs dans scene test
 *    QSqlQuery query;
    query.exec("INSERT INTO SceneTest(nom,couleurscene,L1,L2,L3)"
               "VALUES ('Testcpp',#814603,#814603,#814603,#814603)");*/

    //ajouter valeur dans scenetest avec vérification console
    /*QSqlQuery query;
    if(query.exec("INSERT INTO SceneTest(nom,couleurscene,L1,L2,L3) VALUES ('Testcpp','#814603','#814603','#814603','#814603')"))
    {
        std::cout << "La scène à bien été ajoutée" << std::endl;
    }
    else
    {
        std::cout << "Une erreur s'est produite. La scène n'a pas été crée " << std::endl << q2c(query.lastError().text()) << std::endl;
    }*/

}
MainWindow::~MainWindow()
{
    delete ui;
}

//bouton se connecter à la BDD relié à QT
void MainWindow::SeConnecter()
{
    if(db.open())
       {
           qDebug() << "Connexion réussie à " << db.hostName();
           ui->label->setText("Vous vous êtes bien connecté à la BDD");
       }
       else  //si elle ne se connecte pas, message d'erreur
       {
           qDebug() << "La connexion a échouée !";

       }
}

//bouton créer une scène
void MainWindow::CreerScene()
{
    QSqlQuery query;
    if(query.exec("INSERT INTO SceneTest(nom,couleurscene,L1,L2,L3) VALUES ('Testcpp','#814603','#814603','#814603','#814603')"))
    {
        std::cout << "La scène à bien été ajoutée" << std::endl;
    }
    else
    {
        std::cout << "Une erreur s'est produite. La scène n'a pas été crée " << std::endl << q2c(query.lastError().text()) << std::endl;
    }
}
