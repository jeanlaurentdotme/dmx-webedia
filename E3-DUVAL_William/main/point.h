#include <string>
#include <vector>

class Scene {
public:
	void createScene(std::string name);
	void updateScene(int id, std::string name);
	void deleteScene(int id);

	std::string getSceneName(int id);
	std::vector<int> getAllSceneIds();
};

class Lighting {
public:
	void setLightIntensity(int id, float intensity);
	void setLightColor(int id, std::string color);

	float getLightIntensity(int id);
	std::string getLightColor(int id);
};

class Database {
public:
	void insertScene(int id, std::string name);
	void updateScene(int id, std::string name);
	void deleteScene(int id);

	std::string getSceneName(int id);
	std::vector<int> getAllSceneIds();

	void insertLight(int id, std::string name, float intensity, std::string color);
	void updateLight(int id, std::string name, float intensity, std::string color);
	void deleteLight(int id);

	std::string getLightName(int id);
	float getLightIntensity(int id);
	std::string getLightColor(int id);
};

