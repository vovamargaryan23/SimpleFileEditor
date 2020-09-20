<?php
error_reporting(-1);
class FileEdit
{
    public $file;
    private $path_parts = array();
    public function __construct($filePath)
    {
        $this->file = $filePath;
        $this->path_parts = pathinfo($filePath);

    }

    public function getPath()
    {
        return $this->path_parts['basename'];
    }
    public function getDir()
    {return realpath($this->file);}

    public function getName()
    {return $this->path_parts['filename'];}
    public function getExt()
    {return $this->path_parts['extension'];}
    public function getSize()
    {return filesize($this->file);}
	
    public function getText()
    {
        return nl2br(file_get_contents($this->file));
    }
    public function setText($text)
    {
        $a = file_put_contents($this->file, $text);

        if($a)
        {
            return "Текст успешно записан!";
        }
        else
        {
            return "Произошла Ошибка!";
        }
    }
    public function appendText($text)
    {
        $f = fopen($this->file, "a+");
        $b = fwrite($f, "\n".$text);
        if($b)
        {
            return "Текст успешно добавлен";
        }
        else
        {
            return "Произошла Ошибка!";
        }
        fclose($f);
    }
    public function create($fname)
    {
        $f = fopen($fname, "w+");
        if($f)
        {
            return "Файл успешно создан";
        }
        else
        {
            return "Произошла Ошибка!";
        }
    }
    public function delete()
    {
        $fDel = unlink($this->file);
        if($fDel)
        {
            return "Файл успешно удалён";
        }
        else
        {
            return "Произошла Ошибка!";
        }
    }
    
}

$obj = new FileEdit("text.txt");
echo $obj->create("text.txt");
?>