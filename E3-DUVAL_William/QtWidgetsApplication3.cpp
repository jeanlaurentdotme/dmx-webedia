#include "QtWidgetsApplication3.h"

QtWidgetsApplication3::QtWidgetsApplication3(QWidget *parent)
	: QMainWindow(parent)
{

	ui.setupUi(this);
}

void QtWidgetsApplication3::onDisplayMessageButtonClicked()
{
	ui.label->setText("Une scene a ete cree");
};

