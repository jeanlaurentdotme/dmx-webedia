/*#ifndef MODIFICATION_H
#define MODIFICATION_H

#include <QMainWindow>
#include <QSqlDatabase>
#include <QString>

QT_BEGIN_NAMESPACE
namespace Ui { class modification; }
QT_END_NAMESPACE


class modification : public QWidget
{
    Q_OBJECT

public:
    modification();

private:
    Ui::modification *ui;
    QSqlDatabase db;
    QString nom;
    QString couleurscene;
    QString couleurL1;
    QString couleurL2;
    QString couleurL3;

public slots:
    void SeConnecter();
    void CreerScene();
    void ModifScene();
};

#endif // MODIFICATION_H
*/
