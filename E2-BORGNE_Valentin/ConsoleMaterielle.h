#pragma once

#include <qobject.h>
#include <qserialport.h>
#include <qtimer.h>

class ConsoleMaterielle : public QObject
{
	Q_OBJECT

private:
    bool init;
    QSerialPort* serialPort;
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
    // potValueChanged : parametre 1 = numero du potentiometre ; parametre 2 = valeur du potentiometre
    void potValueChanged(int, int);
    void buttonPushed(int, int);

};

