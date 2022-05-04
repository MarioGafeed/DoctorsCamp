<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CourseCertificateController extends Controller
{
    public function __invoke(Course $course)
    {
        $this->userHasFinishedCourse($course);

        $certificate = Certifiate::where([
            'course_id' => $course->id,
            'user_id' => auth()->user()->id,
        ])->firstOr(function () use ($course) {
            return $this->generateCertificate($course);
        });

        return response()->json([
            'success' => true,
            'url' => $certificate->getFirsdtMediaUrl(),
        ]);
    }

    public function userHasFinishedCourse(Course $course)
    {
        // check if the user has finished the course
        // if the user watched/completed the course lessons
        $userHasFinishedCourse = false;

        abort_unless($userHasFinishedCourse, 403);
    }

    public function generateCertificate(Course $course): Certifiate
    {
        $pdfFileName = $this->user->id.'_'.time().'.pdf';
        $pathInDisk = $this->user->id.DIRECTORY_SEPARATOR.$pdfFileName;
        $pdfFilePath = Storage::disk('local')->path($pathInDisk);

        $pdf = new FPDF();
        $pdf->SetFont('Arial', 'B', 11);

        $pdf->AddPage('P', 'A4');
        $pdf->Image(public_path('templates/base_certificate_template.png'), 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight(), 'jpg');

        // $pdf->Text(100, 100, auth()->user()->name);
        // $pdf->Text(150, 150, $course->title);
        // all logic here ...

        File::put($pdfFilePath, $pdf->Output('S'));

        $certificate = Certifiate::create([
            'course_id' => $course->id,
            'user_id' => auth()->user()->id,
        ]);
        $certificate->addMediaFromDisk($pathInDisk)->toMediaCollection();
        $certificate->fresh();

        return $certificate;
    }
}
