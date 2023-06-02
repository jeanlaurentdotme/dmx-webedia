<?php
// définie des noms pour les différents identifiants de connexion afin de ne pas les insérer dans le code
define ('SERVEUR', '192.168.64.144');
define ('LOGIN', "root");
define ('MDP', "root");
define ('BDD', "PROJETWEBEDIA");



function getInstantiatedEquipments($connexion)
{
    $sql = 'SELECT InstanceEquipement.id, InstanceEquipement.idEquipement, InstanceEquipement.adresse, CanalEquipement.orderIndex, CanalEquipement.name, Equipement.name AS equipementName FROM InstanceEquipement INNER JOIN CanalEquipement ON CanalEquipement.idEquipement = InstanceEquipement.idEquipement INNER JOIN Equipement ON Equipement.id = InstanceEquipement.idEquipement ORDER BY InstanceEquipement.id, CanalEquipement.orderIndex ASC';

   $req = mysqli_query($connexion, $sql) or die('Erreur SQL !'.$sql.'<br />'.mysqli_error($connexion));
   $equipData = [];
   while($data = mysqli_fetch_array($req, MYSQLI_ASSOC))
   {
        $id = $data['id'];
        if (!array_key_exists($id, $equipData))
        {
            $equipData[$id]['data'] = array();
        }

        array_push($equipData[$id]['data'], $data);
   }

   return $equipData;
}
?>