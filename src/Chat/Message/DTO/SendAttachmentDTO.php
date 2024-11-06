<?php
declare(strict_types=1);

namespace Chat\Message\DTO;

use Illuminate\Http\UploadedFile;
use Pandawa\Component\Message\AbstractMessage;

/**
 * @author frada <fbahezna@gmail.com>
 */
class SendAttachmentDTO extends AbstractMessage
{
    private string $chatroom;

    private string $user;

    private string $filepath;

    public function getChatroom(): string
    {
        return $this->chatroom;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getFilepath(): string
    {
        return $this->filepath;
    }
}