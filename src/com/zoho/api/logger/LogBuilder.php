<?php
namespace com\zoho\api\logger;

class LogBuilder
{
    private $level;

    private $filePath;

    public function level($level)
    {
        $this->level = $level;

        return $this;
    }

    public function filePath($filePath)
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function build()
    {
        return Logger::getInstance($this->level, $this->filePath);
    }
}
?>