<?php 

class Categories {

    function __construct() {
        global $database;
        $this->database = $database;
    }

    function Kategori_List($Kategori_Id=0)
    {
        /*
        *  Kategori Listesini Array olarak döndürür.
        *  
        *  Eğer $Kategori_Id SET edilmiş ise sadece o kategorinin alt kategorilerinin döndürür.
        * 
        */
        // Kategorilerin bulunduğu tablomuzdan tüm kayıtları alıyoruz.
        $this->database->query('SELECT ID,Name,ParentID FROM categories ORDER BY OrderNumber ASC');
        $line =  $this->database->getRows();
       // exit;
        // $list değişkeninde sırayla tümkategoriler bulunuyor.
        $list=array();
        foreach($line as $row) {
            $list[$row['ID']]=$row;
        }

        // Şimdi sırayla eklenmişleri hiyerarşilenmiş bir biçimde $tree değişkenine vereceğiz.
        $tree = array();

        // Her bir kategoriyi tek tek döndür...
        foreach ($list as $id => $item)
        {

            if ($Kategori_Id > 0){
                // Eğer kategori id set edilmiş ise birincil düzey yap...
                $kontrol=$Kategori_Id;
            }else{
                // Eğer kategori birincil düzey ise... (yani alt kategorileri almıyoruz!)
                $kontrol=0;
            }

            if ($item['ParentID'] == $kontrol)
            {
                // $tree değişekeninde birincil düzey olarak ekledik.
                $tree[$item['ID']] = $item;

                // Bu kategoriyi kaydettiğimiz için de (yani işimiz bitti!) $list dizisinden kaldırıyoruz.
                unset($list[$id]);

                // Ve şimdi can alıcı nokta! Bu ana kategorinin alt kategorisi var mı diye alt kategorilerine bakıyoruz...
                $this->Kategori_Find_Sub_Cats($list, $tree[$item['ID']]);
            }
        }

        return $tree;
    }

    function Kategori_Find_Sub_Cats(&$list, &$selected)
    {
        /*  Kategori_List() fonksiyonu ile beraber çalışır.
        *  Alt kategorileri arayan yardımcı fonksiyonumuz.
        *  &$list: Veritabanından çektiğimiz ham kategorileri içeriyor.
        *  &$selected: Üzerinde işlem yapılacak (varsa alt kategorisi eklenecek) kategoriyi içeriyor.
        */

        // Her bir kategoriyi tek tek döndür...
        foreach ($list as $id => $item)
        {
            // Eğer babasının kimliğiyle kendi kimliği aynıysa... (yani alt kategori ise!)
            if ($item['ParentID'] == $selected['ID'])
            {
                // Seçimin "sub_cats"ına alt kategorisini ekle.
                $selected['sub_cats'][$item['ID']] = $item;

                // Babasını bulduğuna göre artık $list'eden kaldırabiliriz.
                unset($list[$id]);

                // Alt kategorinin de çocuğu olabilme ihtimali için aynı işlemleri ona da yapıyoruz...
                $this->Kategori_Find_Sub_Cats($list, $selected['sub_cats'][$item['ID']]);
            }
        }
    }

}

?>