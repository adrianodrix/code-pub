<?php namespace CodeEdu\Book\Fakers;

use Faker\Provider\Base;

/**
 * Class ChapterFakerProvider
 * @package CodeEdu\Book\Fakers
 */
class ChapterFakerProvider extends Base
{
    /**
     * Get markdown faker subtitle and content
     *
     * @param int $numSubTitles
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function markdown($numSubTitles = 1)
    {
        $title = $this->generator->sentence(3);
        $contents = [];
        foreach (range(1, $numSubTitles) as $value) {
            $contents[] = [
                'subtitle' => $this->generator->sentence(2),
                'content' => $this->generator->paragraph(10)
            ];
        }
        return view('codeedubook::fakers.chapter', compact('title', 'contents'));
    }
}