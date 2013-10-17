<?php
require('2net_partner.php');

class Sample {

    private $db;

    public function __construct() {
        $this->db = new SQLite3("sample.sqlite");
        $this->db->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, email TEXT UNIQUE, pass TEXT, guid TEXT)");
    }

    public function create_guid() {
        # very basic GUID generator
        $hash = md5(uniqid());
        $guid = substr($hash, 0, 8)."-".substr($hash, 8, 4)."-".substr($hash, 12,4)."-".substr($hash, 16, 4)."-".substr($hash, 20, 12);
        return strtoupper($guid);
    }

    public function login($email, $pass) {
        $count = $this->db->querySingle("SELECT count(1) FROM users WHERE email = '${email}' AND pass = '${pass}'");
        return $count == 1;
    }

    public function register($email, $pass) {
        $guid = $this->create_guid();
        $this->db->exec("INSERT INTO users (email, pass, guid) VALUES ('${email}', '${pass}', '${guid}')");
    }

    public function get_guid($email) {
        return $this->db->querySingle("SELECT guid FROM users WHERE email = '${email}'");
    }

    public function print_users() {
        $query = $this->db->query("select * from users");
        while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
            echo $row['email'] . " " . $row['pass'] . " " . $row['guid'] . "\n";
        }
    }
}

$api = parse_ini_file('2net.ini');
$twonet = new TwonetPartner($api['endpoint'], $api['key'], $api['secret']);
$app = new Sample();

