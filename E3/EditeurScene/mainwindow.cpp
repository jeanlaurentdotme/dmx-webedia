//Les includes permettant l'accés à certaines fonctions utiles
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
#include <QMessageBox>
#include <QString>
#include <QTableWidget>
#include <stdlib.h>


/*
QVariant variant;
QString string = variant.toString();
//puis en std string
std::string str = string.toStdString();
*/

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

    //conexion à la BDD test sans fonction ---------------------------------------------------------------------------------------------------------------
    if(db.open())
       {
           qDebug() << "Connexion réussie à " << db.hostName();
       }
       else
       {
           qDebug() << "La connexion a échouée !";

       }



    //afficher avec une recherche -------------------------------------------------------------------------------------------------------------------------
/*    QSqlQuery query;
    if(query.exec("SELECT nom WHERE id = 2 FROM SceneTest"))
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


/*   //ajouter des valeurs / scene dans scene test ------------------------------------------------------------------------------------------------------------------
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


    //Modification de scène -----------------------------------------------------------------------------------------------------------------------------------

       //modifer scene dans scenetest avec vérification console
       /*QSqlQuery query;
       if(query.exec("UPDATE SceneTest SET nom = 'testmodif' WHERE id = 46"))
       {
           std::cout << "La scène à bien été modifiée" << std::endl;
       }
       else
       {
           std::cout << "Une erreur s'est produite. La scène n'a pas été modifiée " << std::endl << q2c(query.lastError().text()) << std::endl;
       }*/

/*    //lorsque appuyer sur bouton modifier scène ---> tous supprimer pour afficher une autre page (test)------------------------------------------------------------
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->pushButton, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->pushButton_2, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->label, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->label_2, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->label_3, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->label_4, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->label_5, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->label_6, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->label_7, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->lineEdit, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->lineEdit_2, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->lineEdit_3, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->lineEdit_4, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->lineEdit_5, SLOT(hide()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), ui->pushButton_3, SLOT(hide()));*/

//delete ui car plus utile ensuite
}
MainWindow::~MainWindow()
{
    delete ui;
}


//bouton se connecter à la BDD relié à QT-----------------------------------------------------------------------------------------------------------------------
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

//bouton créer une scène--------------------------------------------------------------------------------------------------------------------------------------------
void MainWindow::CreerScene()
{
    //initialisation des variable relié au champ de texte à entrer pour pouvoir ajouter les nom et couleur de scène souhaiter par l'utilisateur
    QString nom = ui->lineEdit->text();
    QString couleurscene = ui->lineEdit_2->text();
    QString couleurL1 = ui->lineEdit_3->text();
    QString couleurL2 = ui->lineEdit_4->text();
    QString couleurL3 = ui->lineEdit_5->text();

    //test si les valeur sont bien rentré
    /*qDebug() << "Le nom est " << nom;
    qDebug() << "La couleur de la scène est " << couleurscene;
    qDebug() << "La couleur de la première lumière est " << couleurL1;
    qDebug() << "La couleur de la seconde lumière est " << couleurL2;
    qDebug() << "La couleur de la troisième lumière est " << couleurL3;*/

    //ajout de la scène
    QSqlQuery query;
    if(query.exec("INSERT INTO SceneTest(nom,couleurscene,L1,L2,L3) VALUES (' " +nom+" ','"+couleurscene+"','"+couleurL1+"','"+couleurL2+"','"+couleurL3+"')"))
    {
        std::cout << "La scène à bien été ajoutée" << std::endl;
        ui->label_7->setText("La scène à bien été ajoutée");
    }
    else
    {
        std::cout << "Une erreur s'est produite. La scène n'a pas été crée " << std::endl << q2c(query.lastError().text()) << std::endl;
    }
}


//bouton affichage de la liste des scène QT---------------------------------------------------------------------------------------------------------------------
void MainWindow::AfficherListeScene()
{
    QSqlQueryModel *model = new QSqlQueryModel();
    model->setQuery( "SELECT id, nom FROM SceneTest" );

    QTableView *view = new QTableView();
    view->setModel( model );
    view->show();
}


//bouton rentrer l'id de la scène que l'on souhaite modifier---------------------------------------------------------------------------------------------------------------
void MainWindow::RentrerIdModifScene()
{
    //variable de l'id rentré qui va permettre de modifier la scène voulu
    idModif = ui->lineEdit_6->text();


    ui->label_9->setText("Vous avez sélectionner la modification de la scène id = " +idModif);
    //test si l'id rentrer est bien stocker dans idModif
    /*qDebug() << "L'id choisi est " << idModif;*/

    //transforme l'id modif en int pour l'étape suivante
    bool ok;
    idModif2 = 0;
    idModif2 = idModif.toInt(&ok, 10);


    //qDebug() << "L'id choisi est " << idModif2;
}

/*bool isNumeric(std::string const &str)
{
    auto it = str.begin();
    while (it != str.end() && std::isdigit(*it)) {
        it++;
    }
    return !str.empty() && it == str.end();
}*/

//bouton modifier la scène en fonction de l'id choisi----------------------------------------------------------------------------------------------------------------------
void MainWindow::ModifScene()
{
    qDebug() << idModif2;
    //Message d'erreur dans le cas ou aucun ID n'est enregistrer
    if (idModif2==0 /*&& std::atoi(idModif) == 0 */)
    {
            ui->label_9->setText("Vous devez d'abord rentrer l'ID de la scène à modifier");
    }
    else
    {
        QString nomModif = ui->lineEdit_8->text();
        QString couleursceneModif = ui->lineEdit_11->text();
        QString couleurL1Modif = ui->lineEdit_7->text();
        QString couleurL2Modif = ui->lineEdit_10->text();
        QString couleurL3Modif = ui->lineEdit_9->text();



        //test si les valeur sont bien rentré
        /*qDebug() << "Le nom est " << nomModif;
        qDebug() << "La couleur de la scène est " << couleursceneModif;
        qDebug() << "La couleur de la première lumière est " << couleurL1Modif;
        qDebug() << "La couleur de la seconde lumière est " << couleurL2Modif;
        qDebug() << "La couleur de la troisième lumière est " << couleurL3Modif;*/


        //modification de la scène
        qDebug() << "UPDATE SceneTest SET nom = '"+nomModif+"', couleurscene = '"+couleursceneModif+"', L1 = '"+couleurL1Modif+"', L2 = '"+couleurL2Modif+"', L3 = '"+couleurL3Modif+"' WHERE id = "+idModif;
        QSqlQuery query;
        if(query.exec("UPDATE SceneTest SET nom = '"+nomModif+"', couleurscene = '"+couleursceneModif+"', L1 = '"+couleurL1Modif+"', L2 = '"+couleurL2Modif+"', L3 = '"+couleurL3Modif+"' WHERE id = "+idModif))
        {
            std::cout << "La scène à bien été modifiée" << std::endl;
            //ui->label_7->setText("La scène à bien été ajoutée");
        }
        else
        {
            std::cout << "Une erreur s'est produite. La scène n'a pas été modifiée " << std::endl << q2c(query.lastError().text()) << std::endl;
        }
    }

void MainWindow::SupprimerScene()
{
    //Message d'erreur dans le cas ou aucun ID n'est enregistrer
    if (idModif2==0 /*&& std::atoi(idModif) == 0 */)
    {
            ui->label_9->setText("Vous devez d'abord rentrer l'ID de la scène à supprimer");
    }
}
}
