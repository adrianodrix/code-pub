<?php namespace CodeEdu\Book\Services;

use CodeEdu\Book\Models\Book;
use CodeEdu\Book\Repositories\Contracts\ChapterRepository;
use CodeEdu\Book\Repositories\Criterias\FindByBookCriteria;
use CodeEdu\Book\Repositories\Criterias\OrderByOrderCriteria;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

/**
 * Class BookExport
 * @package CodeEdu\Book\Services
 */
class BookExport
{
    /**
     * @var ChapterRepository
     */
    private $chapterRepository;
    /**
     * @var Parser
     */
    private $ymlParser;
    /**
     * @var Dumper
     */
    private $ymlDumper;

    /**
     * BookExport constructor.
     * @param ChapterRepository $chapterRepository
     * @param Parser $ymlParser
     * @param Dumper $ymlDumper
     */
    public function __construct(ChapterRepository $chapterRepository, Parser $ymlParser, Dumper $ymlDumper)
    {
        $this->chapterRepository = $chapterRepository;
        $this->ymlParser = $ymlParser;
        $this->ymlDumper = $ymlDumper;
    }

    /**
     * Export Book
     *
     * @param Book $book
     */
    public function export(Book $book)
    {
        $chapters = $this->chapterRepository
            ->pushCriteria(new FindByBookCriteria($book->id))
            ->pushCriteria(new OrderByOrderCriteria())
            ->all();

        $this->exportContents($book, $chapters);

        file_put_contents("{$book->contents_storage}/dedication.md", $book->dedication);

        $configContents = file_get_contents($book->template_config_file);
        $config = $this->ymlParser->parse($configContents);

        $config['book']['title'] = $book->title;
        $config['book']['author'] = $book->author->name;
        // $config['book']['language'] = config('app.locale');

        $contents = [];
        foreach ($chapters as $chapter) {
            $contents[] = [
                'element' => 'chapter',
                'number' => $chapter->order,
                'content' => "{$chapter->order}.md"
            ];
        }

        $config['book']['contents'] = array_merge($config['book']['contents'], $contents);
        $yml = $this->ymlDumper->dump($config, 4);

        file_put_contents($book->config_file, $yml);
    }

    /**
     * Export contents book
     *
     * @param Book $book
     * @param Collection $chapters
     */
    protected function exportContents(Book $book, Collection $chapters)
    {
        if(!is_dir($book->contents_storage)){
            mkdir($book->contents_storage, 0775, true);
        }

        foreach ($chapters as $chapter) {
            file_put_contents("{$book->contents_storage}/{$chapter->order}.md", $chapter->content);
        }
    }

    /**
     * Generate Zip file
     * @param Book $book
     */
    public function compress(Book $book) {
        ExtendedZip::zipTree($book->output_storage, $book->zip_file, ExtendedZip::CREATE);
    }
}