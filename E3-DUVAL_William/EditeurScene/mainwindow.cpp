//Les includes permettant l'accés à certaines fonctions utiles
#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <iostream>
#include <string.h>
#include <qdebug.h>
#include <QtSql/QtSql>
#include <QtGui>
#include <QCoreApplication>
#include <QtWidgets/QMainWindow>
#include <QLineEdit>
#include <qlineedit.h>
#include <QTextEdit>
#include <QList>
#include <QMessageBox>
#include <QString>
#include <QTableWidget>
#include <stdlib.h>
#include <QDialog>
#include <QApplication>
#include <QProcess>
#include <QColorDialog>
#include <cstring>
#include <string>
#include <algorithm>
#include <QGradient>


/*
QVariant variant;
QString string = variant.toString();
//puis en std string
std::string str = string.toStdString();
*/
using namespace std;
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

    /*
    //conexion à la BDD test sans fonction ---------------------------------------------------------------------------------------------------------------
    if(db.open())
       {
           qDebug() << "Connexion réussie à " << db.hostName();
       }
       else
       {
           qDebug() << "La connexion a échouée !";

       }
      */


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

    ui->label->setStyleSheet("QLabel { background-color : red;}"); //mettre le label indiquant que la base de données n'est pas encore connecté en rouge

    //connexion des boutons aux fonctions associée------------------------------------------------------------------------------------------------------------------
    QObject::connect(ui->pushButton, SIGNAL(clicked()), this, SLOT(SeConnecter()));
    QObject::connect(ui->pushButton_2, SIGNAL(clicked()), this, SLOT(CreerScene()));
    QObject::connect(ui->pushButton_3, SIGNAL(clicked()), this, SLOT(AfficherListeScene()));
    QObject::connect(ui->pushButton_4, SIGNAL(clicked()), this, SLOT(RentrerIdModifScene()));
    QObject::connect(ui->pushButton_5, SIGNAL(clicked()), this, SLOT(ModifScene()));
    QObject::connect(ui->pushButton_6, SIGNAL(clicked()), this, SLOT(SupprimerScene()));
    QObject::connect(ui->pushButton_7, SIGNAL(clicked()), this, SLOT(Exit()));
    QObject::connect(ui->pushButton_8, SIGNAL(clicked()), this, SLOT(Reset()));
    QObject::connect(ui->pushButton_9, SIGNAL(clicked()), this, SLOT(Color()));
    QObject::connect(ui->pushButton_10, SIGNAL(clicked()), this, SLOT(SelecCouleurScene()));
    QObject::connect(ui->pushButton_11, SIGNAL(clicked()), this, SLOT(SelecCouleurL1()));
    QObject::connect(ui->pushButton_12, SIGNAL(clicked()), this, SLOT(SelecCouleurL2()));
    QObject::connect(ui->pushButton_13, SIGNAL(clicked()), this, SLOT(SelecCouleurL3()));

    //couleur du fond de la fenetre
    setStyleSheet("QMainWindow {background-color : #338B97;}");      // rouge : DF6139   jaune : #DFA139 bleu : #338B97

    //couleur sur les boutons en jaune
    ui->pushButton->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_2->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_3->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_4->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_5->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_6->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_7->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_8->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_9->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_10->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_11->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_12->setStyleSheet("QPushButton { background-color : #DFA139;}");
    ui->pushButton_13->setStyleSheet("QPushButton { background-color : #DFA139;}");


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
    ResetColor();
    if(db.open()) //si la bdd se connecte
       {
           //qDebug() << "Connexion réussie à " << db.hostName();
           ui->label->setText("               Vous vous êtes bien connecté à la BDD");
           ui->label->setStyleSheet("QLabel { background-color : lightgreen;}");

       }
       else  //si elle ne se connecte pas, message d'erreur
       {
           ui->label->setText("Erreur lors de la connexion, veuillez réessayer");
           ui->label->setStyleSheet("QLabel { background-color : red; color : blue; }");

           //qDebug() << "La connexion a échouée !";

       }

}

//bouton créer une scène--------------------------------------------------------------------------------------------------------------------------------------------
void MainWindow::CreerScene()
{
    ResetColor();

    //initialisation des variables reliés au champ de texte à entrer pour pouvoir ajouter les nom et couleur de scène souhaiter par l'utilisateur
    QString nom = ui->lineEdit->text();
    QString couleurscene = ui->lineEdit_2->text();
    QString couleurL1 = ui->lineEdit_3->text();
    QString couleurL2 = ui->lineEdit_4->text();
    QString couleurL3 = ui->lineEdit_5->text();

    //test si les valeurs sont bien rentré
    /*qDebug() << "Le nom est " << nom;
    qDebug() << "La couleur de la scène est " << couleurscene;
    qDebug() << "La couleur de la première lumière est " << couleurL1;
    qDebug() << "La couleur de la seconde lumière est " << couleurL2;
    qDebug() << "La couleur de la troisième lumière est " << couleurL3;*/

    //ajout de la scène
    if(nom != NULL && couleurscene !=NULL && couleurL1 !=NULL && couleurL2 !=NULL && couleurL3 !=NULL) //si toutes les cases on été remplie
    {
        if(VerifHexa(couleurscene) == true && VerifHexa(couleurL1) == true && VerifHexa(couleurL2)== true && VerifHexa(couleurL3) == true)
        {
            QSqlQuery query;
            if(query.exec("INSERT INTO SceneTest(nom,couleurscene,L1,L2,L3) VALUES (' " +nom+" ','"+couleurscene+"','"+couleurL1+"','"+couleurL2+"','"+couleurL3+"')"))
            {
                //std::cout << "La scène à bien été ajoutée" << std::endl;
                ui->label_7->setText("            La scène à bien été crée");
                ui->label_7->setStyleSheet("QLabel {background-color : lightgreen;}");
            }
            else // si l'ajout rencontre une erreur
            {
                ui->label_7->setText("          Erreur lors de la création");
                //std::cout << "Une erreur s'est produite. La scène n'a pas été crée " << std::endl << q2c(query.lastError().text()) << std::endl;
            }
        }
        else
        {
            ui->label_7->setText("  Les couleurs doivent être en hexa");
            ui->label_7->setStyleSheet("QLabel {background-color : red;}");
        }
    }
    else
    {
        ui->label_7->setText("  Vous devez remplir tous les champs");
        ui->label_7->setStyleSheet("QLabel {background-color : red;}");
    }
}



//bouton affichage de la liste des scène QT---------------------------------------------------------------------------------------------------------------------
void MainWindow::AfficherListeScene()
{
    QSqlQueryModel *model = new QSqlQueryModel();
    model->setQuery( "SELECT id, nom FROM SceneTest" );  //on sélectionne l'ID et le nom car pas besoin d'afficher le reste
    QTableView *view = new QTableView();
    view->setModel( model );
    view->show();
}



//bouton rentrer l'id de la scène que l'on souhaite modifier---------------------------------------------------------------------------------------------------------------
void MainWindow::RentrerIdModifScene()
{
    ResetColor();
    //variable de l'id rentré qui va permettre de modifier la scène voulu
    idModif = ui->lineEdit_6->text();
    ui->label_15->setText("");

    //ui->label_9->setText("Vous avez sélectionner la scène id = " +idModif);
    //test si l'id rentrer est bien stocker dans idModif
    /*qDebug() << "L'id choisi est " << idModif;*/

    //transforme l'id modif en int pour l'étape suivante
    bool ok;
    idModif2 = 0;
    idModif2 = idModif.toInt(&ok, 10);

    if(idModif2!=0)
    {
        ui->label_9->setText("Vous avez sélectionner la scène id = " +idModif);

        //permet de mettre dans la variable nomselec le nom associé à l'ID choisi
        QSqlQuery query;
        if(query.exec("SELECT nom FROM SceneTest WHERE id =" +idModif))
        {
            while(query.next())
            {
                //qDebug() <<" SELECT nom FROM SceneTest WHERE id ="+idModif;
                for(int x=0; x < query.record().count(); ++x)
                {
                    nomSelec = query.value(x).toString() ;
                    //qDebug() << nomSelec;
                }
            }
        }

        //identique pour la couleur
        QSqlQuery query2;
        if(query2.exec("SELECT couleurscene FROM SceneTest WHERE id =" +idModif))
        {
            while(query2.next())
            {
                for(int x=0; x < query2.record().count(); ++x)
                {
                    couleurSceneSelec = query2.value(x).toString() ;
                    //qDebug() << couleurSceneSelec;
                }
            }
        }

        //identique pour la couleur L1
        QSqlQuery query3;
        if(query3.exec("SELECT L1 FROM SceneTest WHERE id =" +idModif))
        {
            while(query3.next())
            {
                for(int x=0; x < query3.record().count(); ++x)
                {
                    couleurL1Selec = query3.value(x).toString() ;
                    //qDebug() << couleurL1Selec;
                }
            }
        }

        //identique pour la couleur L2
        QSqlQuery query4;
        if(query4.exec("SELECT L2 FROM SceneTest WHERE id =" +idModif))
        {
            while(query4.next())
            {
                for(int x=0; x < query4.record().count(); ++x)
                {
                    couleurL2Selec = query4.value(x).toString() ;
                    //qDebug() << couleurL2Selec;
                }
            }
        }

        //identique pour la couleur L3
        QSqlQuery query5;
        if(query5.exec("SELECT L3 FROM SceneTest WHERE id =" +idModif))
        {
            while(query5.next())
            {
                for(int x=0; x < query5.record().count(); ++x)
                {
                    couleurL3Selec = query5.value(x).toString() ;
                    //qDebug() << couleurL3Selec;
                }
            }
        }

       /*
        ui->label_17->setText("La scène sélectionner est donc : id = "+idModif+ ", Nom = " +nomSelec+ ", Couleur = " +couleurSceneSelec);
        ui->label_18->setText( "Lumière 1 = " +couleurL1Selec+ ", Lumière 2 = " +couleurL2Selec+ ", Lumière 3 = " +couleurL3Selec);
        */

        //Pre rempli les line edit des valeurs actuelle de la BDD
        ui->lineEdit_7->setText(nomSelec);
        ui->lineEdit_8->setText(couleurSceneSelec);
        ui->lineEdit_9->setText(couleurL1Selec);
        ui->lineEdit_10->setText(couleurL2Selec);
        ui->lineEdit_11->setText(couleurL3Selec);


    }
    else
    {
         ui->label_9->setText("       Vous devez rentrer un ID qui est un nombre entier non nul");
    }

    //qDebug() << "L'id choisi est " << idModif2;
}

/*  //test pour si numérique ou non (autre méthode utilisé ensuite)
    bool isNumeric(std::string const &str)
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
    ResetColor();

    //qDebug() << idModif2;
    //Message d'erreur dans le cas ou aucun ID n'est enregistrer
    if (idModif2==0 /*&& std::atoi(idModif) == 0 */)
    {
            ui->label_9->setText("Vous devez d'abord rentrer l'ID de la scène à modifier, l'ID doit être un nombre entier");
    }
    else  //sinon effectuer toute la fonction de modification
    {
        QString nomModif = ui->lineEdit_7->text();
        QString couleursceneModif = ui->lineEdit_8->text();
        QString couleurL1Modif = ui->lineEdit_9->text();
        QString couleurL2Modif = ui->lineEdit_10->text();
        QString couleurL3Modif = ui->lineEdit_11->text();



        //test dans la console si les valeurs sont bien rentré
        /*qDebug() << "Le nom est " << nomModif;
        qDebug() << "La couleur de la scène est " << couleursceneModif;
        qDebug() << "La couleur de la première lumière est " << couleurL1Modif;
        qDebug() << "La couleur de la seconde lumière est " << couleurL2Modif;
        qDebug() << "La couleur de la troisième lumière est " << couleurL3Modif;*/


        //modification de la scène

        if(nomModif != NULL && couleursceneModif !=NULL && couleurL1Modif !=NULL && couleurL2Modif !=NULL && couleurL3Modif !=NULL) //si toutes les cases ont été remplie
        {
            if(VerifHexa(couleursceneModif) == true && VerifHexa(couleurL1Modif) == true && VerifHexa(couleurL2Modif)== true && VerifHexa(couleurL3Modif) == true)
            {
                //qDebug() << "UPDATE SceneTest SET nom = '"+nomModif+"', couleurscene = '"+couleursceneModif+"', L1 = '"+couleurL1Modif+"', L2 = '"+couleurL2Modif+"', L3 = '"+couleurL3Modif+"' WHERE id = "+idModif;
                QSqlQuery query;
                if(query.exec("UPDATE SceneTest SET nom = '"+nomModif+"', couleurscene = '"+couleursceneModif+"', L1 = '"+couleurL1Modif+"', L2 = '"+couleurL2Modif+"', L3 = '"+couleurL3Modif+"' WHERE id = "+idModif))
                {
                    //std::cout << "La scène à bien été modifiée" << std::endl;
                    ui->label_16->setText("      La scène à bien été modifiée");
                    ui->label_16->setStyleSheet("QLabel {background-color : lightgreen;}");
                }
                else //message d'erreur
                {
                    ui->label_16->setText("Erreur lors de la modification"
                    "veuillez réessayer");
                    //std::cout << "Une erreur s'est produite. La scène n'a pas été modifiée " << std::endl << q2c(query.lastError().text()) << std::endl;
                }
            }
            else
            {
                ui->label_16->setText("Les couleurs doivent être en hexa");
                ui->label_16->setStyleSheet("QLabel {background-color : red;}");
            }
        }
        else
        {
            ui->label_16->setText("Vous devez remplir tous les champs");
            ui->label_16->setStyleSheet("QLabel {background-color : red;}");
        }

    }
    RentrerIdModifScene(); //rappel de la fonction rentrer ID pour actualiser le texte indiquant le nom, couleur etc de la fonction

    if (idModif2==0 /*&& std::atoi(idModif) == 0 */)
    {
            ui->label_9->setText("Vous devez d'abord rentrer l'ID de la scène à modifier, l'ID doit être un nombre entier");
    }
}

//bouton suppression de scène----------------------------------------------------------------------------------------------------------------------------------------------------
void MainWindow::SupprimerScene()
{
    ResetColor();

    //Message d'erreur dans le cas ou aucun ID n'est enregistrer
    if (idModif2==0 /*&& std::atoi(idModif) == 0 */)
    {
        ui->label_9->setText("Vous devez d'abord rentrer l'ID de la scène à supprimer, l'ID doit être un nombre entier");
    }
    else //sinon effectuer toute la fonction de suppresion
    {
    //suppression de la scène
    QSqlQuery query;
    if(query.exec("DELETE FROM SceneTest WHERE id ="+idModif))
    {
        //std::cout << "La scène à bien été supprimer" << std::endl;
        ui->label_15->setText("La scène à bien été supprimée");
        ui->label_15->setStyleSheet("QLabel {background-color : lightgreen;}");
        /*
        ui->label_17->setText(""); //enlever le texte indiquant la scène qui vient d'être supprimer
        ui->label_18->setText("");
        */
    }
    else //pour message d'erreur
    {
        ui->label_15->setText("Erreur lors de la suppression, veuillez réessayer");
        ui->label_15->setStyleSheet("QLabel {background-color : red;}");
        //std::cout << "Une erreur s'est produite. La scène n'a pas été supprimer " << std::endl << q2c(query.lastError().text()) << std::endl;
    }
    }
}

//bouton quitter la page-----------------------------------------------------------------------------------------------------------------------------------------------------------
void MainWindow::Exit()
{
    close();
}

//bouton réinitialiser la page-------------------------------------------------------------------------------------------------------------------------------------------------------
void MainWindow::Reset()
{
    qApp->quit();  //quitte l'application
    QProcess::startDetached(qApp->arguments()[0], qApp->arguments()); //relance l'application
}

//bouton pour afficher le dialogue de couleur----------------------------------------------------------------------------------------------------------------------------------------
void MainWindow::Color()
{
    color = QColorDialog::getColor(Qt::yellow, this);
    //qDebug() << color.name();
    ui->label_19->setText("Le code hexa de cette couleur est :" +color.name());
}



//fonction pour chercher si la valeur entrer est bien hexadecimal-----------------------------------------------------------------------------------------------------------------
bool MainWindow::ContientHexa(QChar input2)
{
    const char* hex_chars = "0123456789abcdefABCDEF"; // creer une chaine contenant les caractere hexa
    int i = 0;
    bool ok = false;

    while (ok == false && i < 22) //tant que la condition n'est pas egale et i est plus petit que 22 (21 caractere dans la chaine car majuscule inclus)
    {
        if (input2 == hex_chars[i])
        {
            ok = true;
        }
    i+=1;
    }
    return ok;
}


//fonction de verification si valeurs est en hexa-----------------------------------------------------------------------------------------------------------------------------------
bool MainWindow::VerifHexa(QString input)
{
    int input_length = input.length();

    if (input_length != 7)
    {
        return false; // si la chaine de caracteres n a pas exactement 7 caracteres pas hexa
    }

    if (input[0] != '#')
    {
        return false; // si commence pas par # pas hexa
    }
    int j = 1; //debut a 1 car si on commence a 0 le # va arreter la condition
    while ( j <7 && ContientHexa(input[j]))  //tant que i < 7  car 7 caractere -1
    {
        j+=1;
        //qDebug() << j;
    }
    return j == 7;
}


//fonction pour les bouton de selection de la couleur souhaiter-----------------------------------------------------------------------------------------------------------------------
QColor MainWindow::SelecColor()
{
    color2 = QColorDialog::getColor(Qt::yellow, this);
    return color2;
}

//boutons pour selectionner les couleurs qui vont se mettre directement dans les lineEdit-----------------------------------------------------------------------------------------------------

//bouton couleur scene
void MainWindow::SelecCouleurScene()
{
    SelecColor();
    ui->lineEdit_2->setText(color2.name());
}

//bouton couleur L1
void MainWindow::SelecCouleurL1()
{
    SelecColor();
    ui->lineEdit_3->setText(color2.name());
}

//bouton couleur L2
void MainWindow::SelecCouleurL2()
{
    SelecColor();
    ui->lineEdit_4->setText(color2.name());
}

//bouton couleur L3
void MainWindow::SelecCouleurL3()
{
    SelecColor();
    ui->lineEdit_5->setText(color2.name());
}


//fonction réinitialiser les couleur de fond (surtout les texte d erreur/reussite en rouge et vert)----------------------------------------------------------------------------------------------
void MainWindow::ResetColor()
{
    ui->label_7->setText("");
    ui->label_7->setStyleSheet("QLabel {background-color : #338B97;}");
    ui->label_16->setText("");
    ui->label_16->setStyleSheet("QLabel {background-color : #338B97;}");
    ui->label_18->setText("");
    ui->label_18->setStyleSheet("QLabel {background-color : #338B97;}");
}
