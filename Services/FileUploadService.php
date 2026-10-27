<?php
namespace App\Services;

class FileUploadService
{
    private $uploadDir;

    public function __construct($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    private function imagemValida($file) {
    // o PHP precisa ter recebido o arquivo sem erro
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return false;
    }
    // máximo de 10 MB
    if ($file['size'] > 10 * 1024 * 1024) {
        return false;
    }
    // só estas extensões
    $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'], true)) {
        return false;
    }
    // o conteúdo precisa ser uma imagem de verdade (getimagesize devolve false se não for)
    if (@getimagesize($file['tmp_name']) === false) {
        return false;
    }
    return true;
}

    public function uploadImoveis($file)
    {
        if (!empty($file['name']) && $this->imagemValida($file)) {
            $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $fileName = uniqid() . '.' . $extensao;
            $fileDir = $this->uploadDir . '/' . $fileName;
            move_uploaded_file($file['tmp_name'], $fileDir);
            return $fileName;
        }
        return '';
    }

    public function uploadUsers($file)
    {
        if (!empty($file['name'])) {
            $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $fileName = uniqid() . '.' . $extensao;
            $fileDir = $this->uploadDir . '/' . $fileName;
            move_uploaded_file($file['tmp_name'], $fileDir);
            return $fileName;
        }
        return '';
    }

    public function uploadItemLista($arquivos, $indice) {
    $file = [
        'name'     => $arquivos['name'][$indice],
        'tmp_name' => $arquivos['tmp_name'][$indice],
        'error'    => $arquivos['error'][$indice],
        'size'     => $arquivos['size'][$indice],
    ];
    return $this->uploadImoveis($file);
}
}
?>

