/********************************************************************************
** Form generated from reading UI file 'QtWidgetsApplication3.ui'
**
** Created by: Qt User Interface Compiler version 5.15.2
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_QTWIDGETSAPPLICATION3_H
#define UI_QTWIDGETSAPPLICATION3_H

#include <QtCore/QVariant>
#include <QtWidgets/QApplication>
#include <QtWidgets/QCheckBox>
#include <QtWidgets/QLabel>
#include <QtWidgets/QMainWindow>
#include <QtWidgets/QMenuBar>
#include <QtWidgets/QPushButton>
#include <QtWidgets/QSlider>
#include <QtWidgets/QStatusBar>
#include <QtWidgets/QTextEdit>
#include <QtWidgets/QToolBar>
#include <QtWidgets/QWidget>

QT_BEGIN_NAMESPACE

class Ui_QtWidgetsApplication3Class
{
public:
    QWidget *centralWidget;
    QLabel *label;
    QCheckBox *checkBox;
    QSlider *verticalSlider;
    QTextEdit *textEdit;
    QPushButton *pushButton;
    QPushButton *pushButton_2;
    QMenuBar *menuBar;
    QToolBar *mainToolBar;
    QStatusBar *statusBar;

    void setupUi(QMainWindow *QtWidgetsApplication3Class)
    {
        if (QtWidgetsApplication3Class->objectName().isEmpty())
            QtWidgetsApplication3Class->setObjectName(QString::fromUtf8("QtWidgetsApplication3Class"));
        QtWidgetsApplication3Class->resize(601, 400);
        centralWidget = new QWidget(QtWidgetsApplication3Class);
        centralWidget->setObjectName(QString::fromUtf8("centralWidget"));
        label = new QLabel(centralWidget);
        label->setObjectName(QString::fromUtf8("label"));
        label->setGeometry(QRect(30, 20, 71, 41));
        checkBox = new QCheckBox(centralWidget);
        checkBox->setObjectName(QString::fromUtf8("checkBox"));
        checkBox->setGeometry(QRect(210, 30, 70, 17));
        verticalSlider = new QSlider(centralWidget);
        verticalSlider->setObjectName(QString::fromUtf8("verticalSlider"));
        verticalSlider->setGeometry(QRect(150, 90, 22, 160));
        verticalSlider->setMaximum(1024);
        verticalSlider->setOrientation(Qt::Vertical);
        textEdit = new QTextEdit(centralWidget);
        textEdit->setObjectName(QString::fromUtf8("textEdit"));
        textEdit->setGeometry(QRect(320, 150, 201, 81));
        pushButton = new QPushButton(centralWidget);
        pushButton->setObjectName(QString::fromUtf8("pushButton"));
        pushButton->setGeometry(QRect(380, 90, 75, 23));
        pushButton_2 = new QPushButton(centralWidget);
        pushButton_2->setObjectName(QString::fromUtf8("pushButton_2"));
        pushButton_2->setGeometry(QRect(390, 260, 75, 23));
        QtWidgetsApplication3Class->setCentralWidget(centralWidget);
        menuBar = new QMenuBar(QtWidgetsApplication3Class);
        menuBar->setObjectName(QString::fromUtf8("menuBar"));
        menuBar->setGeometry(QRect(0, 0, 601, 21));
        QtWidgetsApplication3Class->setMenuBar(menuBar);
        mainToolBar = new QToolBar(QtWidgetsApplication3Class);
        mainToolBar->setObjectName(QString::fromUtf8("mainToolBar"));
        QtWidgetsApplication3Class->addToolBar(Qt::TopToolBarArea, mainToolBar);
        statusBar = new QStatusBar(QtWidgetsApplication3Class);
        statusBar->setObjectName(QString::fromUtf8("statusBar"));
        QtWidgetsApplication3Class->setStatusBar(statusBar);

        retranslateUi(QtWidgetsApplication3Class);
        QObject::connect(pushButton, SIGNAL(clicked()), QtWidgetsApplication3Class, SLOT(requete()));
        QObject::connect(pushButton_2, SIGNAL(clicked()), QtWidgetsApplication3Class, SLOT(Lirevaleur()));

        QMetaObject::connectSlotsByName(QtWidgetsApplication3Class);
    } // setupUi

    void retranslateUi(QMainWindow *QtWidgetsApplication3Class)
    {
        QtWidgetsApplication3Class->setWindowTitle(QCoreApplication::translate("QtWidgetsApplication3Class", "QtWidgetsApplication3", nullptr));
        label->setText(QCoreApplication::translate("QtWidgetsApplication3Class", "TextLabel", nullptr));
        checkBox->setText(QCoreApplication::translate("QtWidgetsApplication3Class", "CheckBox", nullptr));
        pushButton->setText(QCoreApplication::translate("QtWidgetsApplication3Class", "fdgbhb", nullptr));
        pushButton_2->setText(QCoreApplication::translate("QtWidgetsApplication3Class", "Lire", nullptr));
    } // retranslateUi

};

namespace Ui {
    class QtWidgetsApplication3Class: public Ui_QtWidgetsApplication3Class {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_QTWIDGETSAPPLICATION3_H
