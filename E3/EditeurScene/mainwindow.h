#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
#include <QSqlDatabase>
#include <QString>

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
    QString nom;
    QString couleurscene;
    QString couleurL1;
    QString couleurL2;
    QString couleurL3;

public slots:
    void SeConnecter();
    void CreerScene();
    void AfficherListeScene();
    void ModifScene();
};
#endif // MAINWINDOW_H
