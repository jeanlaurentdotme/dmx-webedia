/********************************************************************************
** Form generated from reading UI file 'QtWidgetsApplication2.ui'
**
** Created by: Qt User Interface Compiler version 5.15.2
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_QTWIDGETSAPPLICATION2_H
#define UI_QTWIDGETSAPPLICATION2_H

#include <QtCore/QVariant>
#include <QtWidgets/QApplication>
#include <QtWidgets/QComboBox>
#include <QtWidgets/QLabel>
#include <QtWidgets/QLineEdit>
#include <QtWidgets/QMainWindow>
#include <QtWidgets/QMenuBar>
#include <QtWidgets/QPushButton>
#include <QtWidgets/QSlider>
#include <QtWidgets/QStatusBar>
#include <QtWidgets/QTextEdit>
#include <QtWidgets/QToolBar>
#include <QtWidgets/QWidget>

QT_BEGIN_NAMESPACE

class Ui_QtWidgetsApplication2Class
{
public:
    QWidget *centralWidget;
    QLabel *label;
    QComboBox *portComboBox;
    QLabel *label_2;
    QTextEdit *textEdit;
    QPushButton *pushButton_2;
    QLabel *portStatusLabel;
    QLineEdit *lineEdit;
    QSlider *verticalSlider;
    QSlider *verticalSlider_2;
    QSlider *verticalSlider_3;
    QMenuBar *menuBar;
    QToolBar *mainToolBar;
    QStatusBar *statusBar;

    void setupUi(QMainWindow *QtWidgetsApplication2Class)
    {
        if (QtWidgetsApplication2Class->objectName().isEmpty())
            QtWidgetsApplication2Class->setObjectName(QString::fromUtf8("QtWidgetsApplication2Class"));
        QtWidgetsApplication2Class->resize(821, 400);
        centralWidget = new QWidget(QtWidgetsApplication2Class);
        centralWidget->setObjectName(QString::fromUtf8("centralWidget"));
        label = new QLabel(centralWidget);
        label->setObjectName(QString::fromUtf8("label"));
        label->setGeometry(QRect(10, 70, 47, 13));
        portComboBox = new QComboBox(centralWidget);
        portComboBox->setObjectName(QString::fromUtf8("portComboBox"));
        portComboBox->setGeometry(QRect(70, 70, 101, 22));
        label_2 = new QLabel(centralWidget);
        label_2->setObjectName(QString::fromUtf8("label_2"));
        label_2->setGeometry(QRect(10, 100, 91, 16));
        textEdit = new QTextEdit(centralWidget);
        textEdit->setObjectName(QString::fromUtf8("textEdit"));
        textEdit->setGeometry(QRect(10, 120, 571, 181));
        pushButton_2 = new QPushButton(centralWidget);
        pushButton_2->setObjectName(QString::fromUtf8("pushButton_2"));
        pushButton_2->setGeometry(QRect(470, 310, 81, 31));
        portStatusLabel = new QLabel(centralWidget);
        portStatusLabel->setObjectName(QString::fromUtf8("portStatusLabel"));
        portStatusLabel->setGeometry(QRect(270, 80, 101, 16));
        lineEdit = new QLineEdit(centralWidget);
        lineEdit->setObjectName(QString::fromUtf8("lineEdit"));
        lineEdit->setGeometry(QRect(10, 310, 451, 31));
        verticalSlider = new QSlider(centralWidget);
        verticalSlider->setObjectName(QString::fromUtf8("verticalSlider"));
        verticalSlider->setGeometry(QRect(610, 120, 22, 160));
        verticalSlider->setMaximum(1024);
        verticalSlider->setOrientation(Qt::Vertical);
        verticalSlider_2 = new QSlider(centralWidget);
        verticalSlider_2->setObjectName(QString::fromUtf8("verticalSlider_2"));
        verticalSlider_2->setGeometry(QRect(650, 120, 22, 160));
        verticalSlider_2->setMaximum(1024);
        verticalSlider_2->setOrientation(Qt::Vertical);
        verticalSlider_3 = new QSlider(centralWidget);
        verticalSlider_3->setObjectName(QString::fromUtf8("verticalSlider_3"));
        verticalSlider_3->setGeometry(QRect(690, 120, 22, 160));
        verticalSlider_3->setMaximum(1024);
        verticalSlider_3->setOrientation(Qt::Vertical);
        QtWidgetsApplication2Class->setCentralWidget(centralWidget);
        menuBar = new QMenuBar(QtWidgetsApplication2Class);
        menuBar->setObjectName(QString::fromUtf8("menuBar"));
        menuBar->setGeometry(QRect(0, 0, 821, 21));
        QtWidgetsApplication2Class->setMenuBar(menuBar);
        mainToolBar = new QToolBar(QtWidgetsApplication2Class);
        mainToolBar->setObjectName(QString::fromUtf8("mainToolBar"));
        QtWidgetsApplication2Class->addToolBar(Qt::TopToolBarArea, mainToolBar);
        statusBar = new QStatusBar(QtWidgetsApplication2Class);
        statusBar->setObjectName(QString::fromUtf8("statusBar"));
        QtWidgetsApplication2Class->setStatusBar(statusBar);

        retranslateUi(QtWidgetsApplication2Class);

        QMetaObject::connectSlotsByName(QtWidgetsApplication2Class);
    } // setupUi

    void retranslateUi(QMainWindow *QtWidgetsApplication2Class)
    {
        QtWidgetsApplication2Class->setWindowTitle(QCoreApplication::translate("QtWidgetsApplication2Class", "QtWidgetsApplication2", nullptr));
        label->setText(QCoreApplication::translate("QtWidgetsApplication2Class", "Port :", nullptr));
        label_2->setText(QCoreApplication::translate("QtWidgetsApplication2Class", "Donn\303\251es re\303\247ues :", nullptr));
        pushButton_2->setText(QCoreApplication::translate("QtWidgetsApplication2Class", "Envoyer", nullptr));
        portStatusLabel->setText(QCoreApplication::translate("QtWidgetsApplication2Class", "Status port : Ferm\303\251", nullptr));
    } // retranslateUi

};

namespace Ui {
    class QtWidgetsApplication2Class: public Ui_QtWidgetsApplication2Class {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_QTWIDGETSAPPLICATION2_H
