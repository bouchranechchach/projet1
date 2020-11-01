<?php


class DatabaseManager {

    private $id;
    private $context;
    private $model;
    private $data;

    /**
     * DatabaseManager constructor.
     * @param $id
     * @param $context
     * @param $model
     */
    public function __construct($id, $context, $model)
    {
        global $main_folder;
        $this->id = $id;
        $this->context = $main_folder.$context;
        $this->model = $model;
        $this->read();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param mixed $context
     */
    public function setContext($context)
    {
        global $main_folder;
        $this->context = $main_folder.$context;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Retourner les données lu apartir du fichier XML
     * @return SimpleXMLElement
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param SimpleXMLElement $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Lire les données a partir de fichier XML donné
     * @return DatabaseManager
     */
    public function read(){
        // lire le fichier XML
        $elem = new SimpleXMLElement(
            file_get_contents($this->getContext() . '/' . $this->getModel() . '/' . $this->getModel() . '.xml')
        );
        $this->setData($elem);
        return $this;
    }

    /**
     * Retourne un noeud si il existe sinon retourn null
     * @param $params
     * @return SimpleXMLElement|null
     */
    public function find($params){
        $data = $this->read()->getData();
        $needle = null;
        foreach ($data as $item){
            $found = true;
            foreach ($params as $key => $value){
                if($item->$key != $value) $found = false;
            }
            // si le noeud est trouvé
            if ($found){
                $needle = $item;
                break;
            }
        }
        return $needle;
    }

    /**
     * Trouver un noeud par ID
     * @param $id
     * @return SimpleXMLElement|null
     */
    public function findById($id){
        $data = $this->read()->getData();
        $needle = null;
        foreach ($data as $item)
            if(((int) $item->attributes()->id) == $id) $needle = $item;
        return $needle;
    }

    /**
     * Trouver un noeud par attribut
     * @param array $attrs
     * @return SimpleXMLElement|null
     */
    public function findByAttributes($attrs=[]){
        $data = $this->read()->getData();
        $needle = null;
        foreach ($data as $item){
            $found = true;
            foreach ($attrs as $key => $value){
                if(((string) $item->attributes()->$key) != $value) $found = false;
            }
            if ($found){
                $needle = $item;
                break;
            }
        }
        return $needle;
    }

    /**
     * Chercher des noeuds avec une(des) condition(s)
     * @param array $fields
     * @return array|null
     */
    public function findWhere($fields=[]){
        $data = $this->read()->getData();
        $items = [];
        foreach ($data as $item){
            $found = true;
            foreach ($fields as $key => $value){
                if(((string) $item->attributes()->$key) != $value && ((string) $item->$key) != $value)
                    $found = false;
            }
            if ($found) $items[] = $item;
        }
        return count($items) ? $items : null;
    }

    /**
     * chercher des noeud qui contient un keyword
     * @param $keyword
     * @return array|null
     */
    public function searchByKeyword($keyword){
        $data = $this->getData();
        $items = [];
        $keyword = strtolower($keyword) == 'homme' ? 'male' : $keyword;
        $keyword = strtolower($keyword) == 'femme' ? 'female' : $keyword;
        foreach ($data as $item){
            if(trim($keyword) == "") {
                $items[] = $item;
                continue;
            }
            $found = false;
            foreach ($item as $key => $value){
                if(strpos(strtolower(((string) $item->$key)), $keyword) !== false) $found = true;
            }
            foreach ($item->attributes() as $key => $value){
                if(((string) $item->attributes()->$key) == $keyword) $found = true;
            }
            if ($found) $items[] = $item;
        }
        return count($items) ? $items : null;
    }

    /***
     * Enregistrer les modifs dans le fichier XML
     * @param $node
     * @return bool
     */
    public function save(){
        // Ecrire dans un fichier XML
        $data = $this->getData();
        $data->saveXML($this->getContext() . '/' . $this->getModel() . '/' . $this->getModel() . '.xml');
        return true;
    }

    /**
     * Supprimer un noeud par ID
     * @param $id
     * @return bool
     */
    public function deleteById($id){
        $data = $this->getData();
        $i = 0;
        foreach ($data as $k => $item){
            if($item->attributes()->id == $id){
                unset($data->$k[$i]);
                return true;
            }
            $i++;
        }
        return false;
    }

    /**
     * Incrémenter l'ID d'un modèle
     * @param $model
     * @return int
     */
    public static function increment($model){
        global $main_folder;
        $m = (new DatabaseManager(1, 'database', 'increments'));
        $incs = $m->getData();
        $incs->$model = ((int) $incs->$model) + 1;
        $m->save();
        return (int) $incs->$model;
    }

    /**
     * Trier un object des noeud en ordre décroissant et retourner un array
     * @param $elem
     * @return array
     */
    public static function rsort($elem){
        $temp = $sorted = [];
        foreach ($elem as $n) $temp[] = $n;
        for($k=count($temp)-1;$k>=0;$k--) $sorted[] = $temp[$k];
        return $sorted;
    }

}