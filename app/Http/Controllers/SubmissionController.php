<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coauthor;
use App\Models\Section;
use App\Models\Submission;
use Illuminate\Http\Request;
use phpseclib3\System\SSH\Agent\Identity;
use Seboettg\CiteProc\CiteProc;
use Seboettg\CiteProc\StyleSheet;

class SubmissionController extends Controller
{


    private $citationStyles = [
        'acm-sig-proceedings' => 'ACM',
        'american-chemical-society' => 'ACS',
        'apa' => 'APA',
        'associacao-brasileira-de-normas-tecnicas' => 'ABNT',
        'chicago-author-date' => 'Chicago',
        'harvard-cite-them-right' => 'Harvard',
        'ieee' => 'IEEE',
        'modern-language-association' => 'MLA',
        'turabian-fullnote-bibliography' => 'Turabian',
        'vancouver' => 'Vancouver'
    ];

    public function cite($id, $style)
    {
        $publication = Submission::find($id);
        $defLocale = $publication->localizedDetails($publication->locale);

        $citation = [[
            "author" => [
                [
                    "given" => $publication->author->first_name,
                    "family" => $publication->author->last_name,
//                    "suffix" => $publication->author->middle_name
                ]
            ],
            "type" => "article-journal",
            "url" => route('submission.show', $publication->id),
            "doi" => $publication->doi,
            "abstract" => $defLocale->abstract,
            "title" => $defLocale->title,
            "container-title" => $defLocale->publisher,
            "issued" => [
                "date-parts" => [
                    [$publication->year]
                ]
            ]
        ]];

        $data = json_encode($citation);
        $style = StyleSheet::loadStyleSheet($style);
        $citeProc = new CiteProc($style);

        return $citeProc->render(json_decode($data), "bibliography");
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        $this->authorize('create', Submission::class);
        if(!session()->has('submission_filename')){
            return view('submissions.upload_form');
        }
        return view('submissions.form', ['sections' => Section::all(), 'categories' => Category::all(), 'user' => auth()->user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {
        $this->authorize('create', Submission::class);

        $user = auth()->user();
        $data = $request->input();


        $submission = $user->submissions()->create([
            'doi' => $data['doi'],
            'published_at' => $data['published_at'],
            'status' => 0,
            'locale' => $data['locale'],
            'file' => $data['path'],
            'citations' => $data['references'] ?? null,
            'preview' => $data['preview_filename'],
            'thumb' => $data['thumb_filename'],
            'category_id' => $data['category_id'],
            'section_id' => $data['section_id']
        ]);

//        dd($data);
        foreach ($data['locales'] as $locale => $items){
            foreach ($data['locales'][$locale] as $key => $value) {
                $submission->details()->create([
                    'locale' => $locale,
                    'key' => $key,
                    'value' => $value
                ]);
            }
        }

        if (isset($data['references'])){
            $i = 1;
            foreach (explode("\r\n", $data['references']) as $ref) {
                $submission->references()->create([
                    'citation' => $ref,
                    'sequence' => $i
                ]);
                $i++;
            }

        }
        if (isset($data['authors'])){
            foreach ($data['authors'] as $author){
                $submission->coauthors()->create([
                    'first_name' => $author['name'],
                    'last_name' => $author['lastname'],
                    'email' => $author['email'],
                    'orcid' => $author['orcid'],
                ]);
            }
        }
        return redirect(route('profile.home'))->with(['messages' => [['status' => 'success', 'message' => 'Your submission saved']]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function show($id)
    {

        $publication = Submission::find($id);

        return view('submissions.show', ['citationStyles' => $this->citationStyles, 'cite' => $this->cite($publication->id, 'apa'), 'publication' => $publication, 'details' => $publication->localizedDetails(app()->getLocale())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Submission $submission
     * @return
     */
    public function edit(Submission $submission)
    {
        $this->authorize('update', $submission);

        return view('submissions.edit', [
            'submission' => $submission,
            'details' => $submission->allLocalizedDetails(),
            'user' => auth()->user(),
            'categories' => Category::all(),
            'sections' => Section::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $submission = Submission::find($id);
        $this->authorize('update', $submission);


        $user = auth()->user();
        $data = $request->input();
        $submission->update([
            'doi' => $data['doi'],
            'published_at' => $data['published_at'],
            'status' => 0,
            'citations' => $data['references'],
            'category_id' => $data['category_id'],
            'section_id' => $data['section_id'],
        ]);
        $submission->details()->delete();
        foreach ($data['locales'] as $locale => $items){
            foreach ($data['locales'][$locale] as $key => $value) {
                $submission->details()->create([
                    'locale' => $locale,
                    'key' => $key,
                    'value' => $value
                ]);
            }
        }
        $submission->references()->delete();
        if (isset($data['references'])){
            $i = 1;
            foreach (explode("\r\n", $data['references']) as $ref) {
                $submission->references()->create([
                    'citation' => $ref,
                    'sequence' => $i
                ]);
                $i++;
            }
        }

        $submission->coauthors()->delete();
        if (isset($data['authors'])){
            foreach ($data['authors'] as $author){
                $submission->coauthors()->create([
                    'first_name' => $author['name'],
                    'last_name' => $author['lastname'],
                    'email' => $author['email'],
                    'orcid' => $author['orcid'],
                ]);
            }
        }
        return redirect(route('profile.home'))->with(['messages' => [['status' => 'success', 'message' => 'Your submission edited']]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Submission $submission
     * @return
     */
    public function destroy(Submission $submission)
    {
        $this->authorize('delete', $submission);
        $submission->delete();
        $submission->references()->delete();
        $submission->coauthors()->delete();
        $submission->details()->delete();
        return back()->with(['messages' => [['status' => 'success', 'message' => 'Publication was deleted']]]);
    }

    public function upload_file(Request $request)
    {

        $user_id = auth()->user()->id;
        $preview_filename = '';
        $thumb_filename = '';
        $full_filename = $user_id .'-full-'. uniqid() . '.' . $request->file('submission_file')->extension();
        $request->file('submission_file')->storeAs('public/submission_files/' . $user_id , $full_filename);
        $isThumbValid = ($request->hasFile('submission_thumbnail')) and ($request->file('submission_thumbnail')->extension() == 'jpg' or $request->file('submission_thumbnail')->extension() == 'jpeg');
        if ($request->hasFile('submission_preview')){
            $preview_filename = $user_id .'-preview-'. uniqid() . '.' . $request->file('submission_preview')->extension();
            $request->file('submission_preview')->storeAs('public/submission_files/' . $user_id , $preview_filename);
        }
        if ($isThumbValid){
            $thumb_filename = $user_id .'-thumb-'. uniqid() . '.' . $request->file('submission_thumbnail')->extension();
            $request->file('submission_thumbnail')->storeAs('public/submission_files/' . $user_id , $thumb_filename);
        }

        return redirect(route('submission.create'))->with([
            'submission_filename' => pathinfo($request->file('submission_file')->getClientOriginalName())['filename'],
            'ext' => $request->file('submission_file')->getClientOriginalExtension(),
            'path' => 'storage/submission_files/' . $user_id . '/' . $full_filename,
            'preview_filename' => $request->hasFile('submission_preview')? 'storage/submission_files/' . $user_id .'/'. $preview_filename : '',
            'thumb_filename' => $isThumbValid ? 'storage/submission_files/' . $user_id .'/'. $thumb_filename : '',
            'submission_locale' => $request->input('locale')
        ]);
    }
}

