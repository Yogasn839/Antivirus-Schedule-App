<?php
class AG {
    var $num_crommosom ; //jumlah kromosom awal yang dibangkitkan
    var $divisi = array(); //data waaktu
    var $user = array(); //data user
    var $manufaktur = array(); //data manufaktur
    var $generation = 0; //generasi ke....
    var $max_generation = 100;
    var $crommosom = array(); //array kromosom sesuai $num_cromosom 
    var $per_sks = 0; // menit per sks
    var $success = false; //keadaan jika sudah ada sulosi terbaik
    var $debug; //menampilkan debug jika diset true;
    var $population = array(); //kumpulan kromosom
    var $solution = array(); //kromosom dengan fitness terbaik
    var $fitness = array(); //nilai fitness setiap kromosom
    var $console = "";
    var $total_fitness = 0;
    var $probability  = array();
    var $com_pro = array();
    var $rand = array();
    var $parent = array();
    
    var $best_fitness = 0;
    var $best_cromossom = array();    
    
    var $crossover_rate = 50;
    
  



    function __construct($divisi, $user, $manufaktur) {
        $this->divisi = $divisi;
        $this->user = $user;
        foreach($manufaktur as $row){
            $this->manufaktur[$row->kode_setting] = $row;  
            $this->manufaktur[$row->kode_setting]->hari = explode(',', $row->hari);
        }             
        $this->num_crommosom = $num_kromosom;         
        $this->per_sks = $per_sks;  
        $this->debug = $debug;              
    }      
    
    function generate(){
        //$this->console.= "<h4>Generasi Awal</h4>";
        $arrCro = $this->get_crommosom();
        
        while(($this->generation <= $this->max_generation) && $this->success == false){            
            $this->console.= "<h3>Generasi ke-$this->generation</h3>";
            $this->show_crommosom();
            $this->show_fitness();
            $this->get_com_pro();
            $this->selection();
            $this->show_crommosom();            
            $this->show_fitness();
            $this->crossover();
            $this->show_crommosom();
            $this->generation++;                
        }        
        $this->save_result();
        
        if(!$this->debug)
            $this->console = "";
            
        $this->console.="\r\nFITNESS TERBAIK: $this->best_fitness";
        $this->console.="\r\nGENERASI: $this->generation";        
        $this->console.="\r\nCROMOSSOM TERBAIK:  " . $this->print_cros($this->best_cromossom);                              
        $this->get_debug();                   
    }
    
    function save_result(){
        global $db;
        $db->query("truncate tb_jadwal");
        foreach($this->best_cromossom as $key => $val){
            $db->query("INSERT INTO tb_jadwal VALUES (
                '".$this->manufaktur[$val['manufaktur']]->kode_setting."', 
                '".$this->user[$val['user']]->kode_divisi."', 
                '".$this->divisi[$val['divisi']]->kode_divisi."')");
        }
    }
    
    function show_crommosom() { 
        $cros = $this->crommosom;
        
        $a = array();
        foreach ($cros as $key => $val) {
            $a[] =  $this->print_cros($val, $key);
        }
        
        $this->console.= implode(" \r\n", $a) . "\r\n";
    }
    
    function print_cros($val = array(), $key = 0){        
        
        $arr = array();
        foreach($val as $k => $v) {                
            $arr[] = '['. implode( ',', $v) . ']';
        }
        return "Kromosom[$key]: (". implode( ',', $arr) . ")";
    }
    
    function show_fitness(){
        $this->fitness = array();
        foreach($this->crommosom as $key => $val) {
            $fit = $this->get_fitness($key);                        
            $this->console.= "F[$key]: $fit[desc] = $fit[nilai] \r\n";
            $this->fitness[] = $fit;                         
        }
        $this->get_total_fitness();
        $this->console.="Total F: ".$this->get_total_fitness() ."\r\n"; 
    }
    
    function crossover(){
        $this->console.= "<h4>Pindah silang generasi ke-$this->generation</h4>";
        $this->parent = array();
        foreach($this->crommosom as $key => $val) {
            $rnd = mt_rand() / mt_getrandmax();
            if($rnd <= $this->crossover_rate / 100)
                $this->parent[] = $key;
        }        
        foreach($this->parent as $key => $val) {
            $this->console.="Parent[$key] : $val \r\n";
        }
                
        $parent = $this->parent;
        $c = count($this->parent);
        
        if( $c > 1 ) {
            for($a = 0; $a < $c-1; $a++) {
                $this->crommosom[$parent[$a]] = $this->get_crossover( $this->crommosom[$parent[$a]],  $this->crommosom[$parent[$a+1]]);
            }    
            $this->crommosom[$this->parent[$c-1]] = $this->get_crossover( $this->crommosom[$this->parent[$c-1]],  $this->crommosom[$this->parent[0]]);
        }        
    }
    
    function get_crossover($cro1, $cro2){
        $offspring = rand(0, count($cro1) - 2);
        $new_cro = array();
        
        for($a = 0; $a < count($cro1); $a++) {                        
            if( $a <= $offspring )
                $new_cro[] =  $cro1[$a];        
            else
                $new_cro[] =  $cro2[$a];        
        }
        
        $this->console.= "Offspring: $offspring \r\n";
        
        return $new_cro;        
    }
    
    function get_debug(){              
        echo "<pre>$this->console</pre>";
    }
            
    function get_crommosom() {
        $numb = 0;
        while(!$this->success && $numb < $this->num_crommosom) {
            $cro = $this->get_rand_crommosom();            
            $this->crommosom[] = $cro;       
                                                
            $numb++;
        }
                
        $arr['kromosom'] = $this->crommosom;
        $arr['fitness'] = $this->fitness;
        $this->population[$this->generation] = $arr;
        
        if(!$this->success)
            $this->generation++;                                  
        return $this->crommosom;
    }                 
    
    function get_total_fitness(){
        $this->total_fitness = 0;
        reset($this->fitness);
        foreach($this->fitness as $val) {
            $this->total_fitness+=$val['nilai'];
        }        
        return $this->total_fitness;
    }
    
    function get_probability(){
        $this->probability = array();
        foreach($this->fitness as $key => $val) {
            $x = $val['nilai'] / $this->total_fitness;
            $this->probability[] = $x;
            //$this->console.="P[$key] : $x \r\n";
        }
        //$this->console.="Total P: " . array_sum($this->probability) . "\r\n";
        reset($this->fitness);
        return $this->probability;
    }
    
    function get_com_pro(){
            
        $this->get_probability(); 
        
        $this->com_pro = array();
        $x = 0;
        foreach($this->probability as $key => $val) {
            $x+= $val;
            $this->com_pro[] = $x;
            //$this->console.="PK[$key] : $x \r\n";
        }        
        reset($this->probability);
        return $this->com_pro;
    }
    
    function selection(){        
        $this->console.="<h4>Seleksi generasi ke-$this->generation</h4>";
        $this->get_rand();
        $new_cro = array();
        foreach ($this->rand as $key => $val) {
            $k = $this->choose_selection($val);
            $new_cro[] = $this->crommosom[$k];
            //$this->console.="K[$key] = K[$k] \r\n";
        }  
        $this->crommosom = $new_cro;
    }
    
    function choose_selection($rand_numb = 0) {    
        foreach($this->com_pro as $key => $val) {
            if($rand_numb <= $val)
                return $key;
        }        
    }
    
    function get_rand(){
        $this->rand = array();
        reset($this->fitness);
        foreach($this->fitness as $key => $val) {
            $r = mt_rand() / mt_getrandmax();
            $this->rand[] = $r;
            //$this->console.="R[$key] : $r \r\n";
        }
    }
    
    function get_rand_crommosom(){
        $result = array();
        $manufakturs = $this->manufaktur;
        
        foreach($manufakturs as $key => $value) {            
            $result[$key]['manufaktur'] =  $key;
            $result[$key]['user'] = rand(0, count($this->user ) -1);
            $result[$key]['divisi'] = rand(0, count($this->divisi ) -1);
        }  
        return $result;                          
    } 
    
    function get_fitness($key) {
        $cro = $this->crommosom[$key];
        //guru sama divisi sama
        $clash_guru = $this->get_clash_guru($cro);
        //user sama divisi sama
        $clash_user = $this->get_clash_user($cro);
        //kelas sama divisi sama
        $clash_kelas = $this->get_clash_kelas($cro);
        
        $f['desc'] = "1/(1+$clash_guru+$clash_user+$clash_kelas)";                                       
        $f['nilai'] = 1/ (1 + $clash_guru + $clash_user + $clash_kelas);
        
        if($f['nilai']==1) // jika sudah optimal maka berhenti
            $this->success = true;
        
        if($f['nilai'] > $this->best_fitness) {
            $this->best_fitness = $f['nilai'];
            $this->best_cromossom = $this->crommosom[$key];
        }
        return $f;
    }
                
    function get_clash_user($crom = array()) {
        $clash = 0;                
        for($a = 0; $a < count($crom) - 1; $a++) {
            for($b = $a + 1 ; $b < count($crom); $b++) {
                if($crom[$a]['user']==$crom[$b]['user']) {                   
                    if($this->is_time_clash($crom[$a], $crom[$b])){                        
                        $clash++;    
                    }         
                } 
            }            
        }
        return $clash;
    }
    
    function get_clash_guru($crom = array()) {
        $clash = 0;                                
        for($a = 0; $a < count($crom) - 1; $a++) {            
            for($b = $a + 1 ; $b < count($crom); $b++) {
                $manufaktur1 = $this->manufaktur[$crom[$a]['manufaktur']];
                $manufaktur2 = $this->manufaktur[$crom[$b]['manufaktur']];
                if($manufaktur1->kode_user==$manufaktur2->kode_user) {                   
                    if($this->is_time_clash($crom[$a], $crom[$b])){                        
                        $clash++;    
                    }         
                } 
            }            
        }
        return $clash;
    }
    
    function get_clash_kelas($crom = array()) {
        $clash = 0;                                
        for($a = 0; $a < count($crom) - 1; $a++) {            
            for($b = $a + 1 ; $b < count($crom); $b++) {
                $manufaktur1 = $this->manufaktur[$crom[$a]['manufaktur']];
                $manufaktur2 = $this->manufaktur[$crom[$b]['manufaktur']];
                if($manufaktur1->kode_manufaktur==$manufaktur2->kode_manufaktur) {                   
                    if($this->is_time_clash($crom[$a], $crom[$b])){                        
                        $clash++;    
                    }         
                } 
            }            
        }
        return $clash;
    }
    
    function is_time_clash($gen1, $gen2){
        $divisi1 = $this->divisi[$gen1['divisi']];
        $divisi2 = $this->divisi[$gen2['divisi']];
                
        if($divisi1->nama_hari == $divisi2->nama_hari) { //jika di hari yang sama
            
            $sks1 = $this->manufaktur[$gen1['manufaktur']]->jumlah_jam;
            $sks2 = $this->manufaktur[$gen2['manufaktur']]->jumlah_jam;
            
            $a = strtotime($divisi1->nama_jam);
            $b = $a + $sks1 * $this->per_sks * 60;      
              
            $x = strtotime($divisi2->nama_jam);
            $y = $x + $sks2 * $this->per_sks * 60;
                         
            if ($a == $x)
                return true;            
            if ($x > $a && $x< $b)                 
                return true;                
            if ($a > $x && $a < $y) 
                return true;            
        }                
    }
            
    
}
