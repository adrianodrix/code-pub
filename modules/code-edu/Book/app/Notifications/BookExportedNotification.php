<?php namespace CodeEdu\Book\Notifications;

use CodeEdu\Book\Models\Book;
use CodeEdu\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookExportedNotification extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Book
     */
    private $book;

    /**
     * Create a new notification instance.
     *
     */
    public function __construct(User $user, Book $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'nexmo', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Seu livro foi exportado!")
            ->greeting("Olá {$this->user->name}")
            ->line("O livro \"{$this->book->title}\" já foi exportado")
            ->action('Download', route('books.download', ['book' => $this->book->id]))
            ->line('Obrigado por usar a nossa aplicação');
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage())
            ->from(config('app.name'))
            ->content("O livro {$this->book->title} já foi exportado. Fazer download em "
                . route('books.download', ['book' => $this->book->id])
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
