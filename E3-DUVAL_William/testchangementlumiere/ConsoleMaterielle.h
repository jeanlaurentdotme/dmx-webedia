#pragma once

#include <qobject.h>
#include <qserialport.h>
#include <qtimer.h>

class ConsoleMaterielle : public QObject
{
	Q_OBJECT

private:
    bool init;
    QSerialPort* serialPort = new QSerialPort();
    int potentiometre1;
    QString buffer;
    QTimer timer;
    QTimer sendTimer;

    QList<QString> messageQueue;

public:

    ConsoleMaterielle(QObject* parent);
    bool initDone() { return init; }

    void setScene(QString sceneName);

private slots:
    void requete();
    void onReadyRead();

    void sendQueuedMessages();

public slots:

signals:
    // potValueChanged : paramètre 1 = numéro du potentiomètre ; paramètre 2 = valeur du potentiomètre
    void potValueChanged(int, int);
    void buttonPushed(int, int);

};

