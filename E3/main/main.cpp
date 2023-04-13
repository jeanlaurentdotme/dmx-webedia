#define _CRT_SECURE_NO_WARNINGS
#include <string.h>
#include <iostream>
#include <stdio.h>

#include <mysql_connection.h>
#include <cppconn/driver.h>
#include <cppconn/exception.h>
#include <cppconn/prepared_statement.h>
#include <stdlib.h>

#include "point.h"
using namespace std;

const string server = "tcp://192.168.44.144";
const string username = "root@192.168.44.144";
const string password = "root";

sql::Driver *driver;
sql::Connection *con;
sql::Statement *stmt;
sql::PreparedStatement *pstmt;

void connexionbdd() {
	try
	{
		driver = get_driver_instance();
		con = driver->connect(server, username, password);
		cout << "La connexion à bien été effectué";
	}
	catch (sql::SQLException e)  //erreur lors de la connexion
	{
		cout << "Impossible de se connecter au serveur, code d'erreur : " << e.what() << endl;
		system("pause");
		exit(1);
	}
}

	//ajout d'une scene
	void createScene(string name) {
		/*
		id clé primaire auto incremente
		*/
		pstmt = con->prepareStatement("INSERT INTO scene(name) VALUES(name)");
		pstmt->setString(1, name);
		pstmt->execute();
		cout << "Une scene ajoutée." << endl;
	}


int main(int argc, char ** argv)
{

	connexionbdd();
	createScene("test");

	string nom_scene = "jeu_test1";

	//con->setSchema("quickstartdb");
/*
	stmt = con->createStatement();
	stmt->execute("DROP TABLE IF EXISTS inventory");
	cout << "Finished dropping table (if existed)" << endl;
	stmt->execute("CREATE TABLE inventory (id serial PRIMARY KEY, name VARCHAR(50), quantity INTEGER);");
	cout << "Finished creating table" << endl;
	delete stmt;
*/



	//modification d'une scene
/*	void updateScene(int id, std::string name){
		pstmt = con->prepareStatement("INSERT INTO scene(id, name) VALUES(?,?) WHERE (id = id, )";
		pstmt->execute();
		cout << "Une scene ajoutée." << endl;
	}*/
	
	//pstmt->setString(, "");
	//pstmt->setInt(2, 150);
	/*pstmt->setString(1, "orange");
	pstmt->setInt(2, 154);
	pstmt->execute();
	cout << "One row inserted." << endl;

	pstmt->setString(1, "apple");
	pstmt->setInt(2, 100);
	pstmt->execute();
	cout << "One row inserted." << endl;
	
	delete pstmt;
	delete con;
	system("pause");

	return 0;*/
}
