<?php
declare(strict_types=1);

namespace Chat\Message\Command;

use Illuminate\Http\UploadedFile;
use Pandawa\Component\Message\AbstractCommand;
use Pandawa\Component\Message\NameableMessageInterface;
use Pandawa\Component\Support\NameableClassTrait;

/**
 * @author frada <fbahezna@gmail.com>
 */
final class SendAttachment extends AbstractCommand implements NameableMessageInterface
{
    use NameableClassTrait;

    private UploadedFile $attachment;
    private string $user;
    private string $chatroom;

    public function getAttachment(): UploadedFile
    {
        return $this->attachment;
    }
    public function getUser(): string
    {
        return $this->user;
    }
    public function getChatroom(): string
    {
        return $this->chatroom;
    }
}