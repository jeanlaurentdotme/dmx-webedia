#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
#include <QSqlDatabase>
#include <QString>
#include <string>
#include <string.h>

QT_BEGIN_NAMESPACE
namespace Ui { class MainWindow; }
QT_END_NAMESPACE


class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    MainWindow(QWidget *parent = nullptr);
    ~MainWindow();

private:
    Ui::MainWindow *ui;
    QSqlDatabase db;
    QString name;
    QString couleurscene;
    QString couleurL1;
    QString couleurL2;
    QString couleurL3;
    QString idModif;
    QString nameModif;
    QString couleursceneModif;
    QString couleurL1Modif;
    QString couleurL2Modif;
    QString couleurL3Modif;
    QString nameSelec;
    QString couleurSceneSelec;
    QString couleurL1Selec;
    QString couleurL2Selec;
    QString couleurL3Selec;
    QColor color;
    QColor color2;
    int idModif2;

public slots:
    void SeConnecter();
    void CreerScene();
    void AfficherListeScene();
    void RentrerIdModifScene();
    void ModifScene();
    void SupprimerScene();
    void Exit();
    void Reset();
    void Color();
    bool VerifHexa(QString input);
    bool ContientHexa(QChar input2);
    QColor SelecColor();
    void SelecCouleurScene();
    void SelecCouleurL1();
    void SelecCouleurL2();
    void SelecCouleurL3();
    void SelecCouleurSceneModif();
    void SelecCouleurL1Modif();
    void SelecCouleurL2Modif();
    void SelecCouleurL3Modif();
    void ResetColor();
};
#endif // MAINWINDOW_H


