<?php

namespace App\Http\Controllers\Api;

use App\Authorizable;
use App\Http\Controllers\Controller;
use App\Helpers\JsonResponder;
use App\Http\Interfaces\FaqInterface;
use App\Http\Requests\FaqsRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
  // use Authorizable;

  public function __construct(private FaqInterface $faqInterface)
  {
  }

  public function index(Request $request)
  {
      $faqs = Faq::query();

        $faqs->when(
                $request->keyword,
                fn ($q) => $q->where('question', 'LIKE', "%$request->keyword%")
                              ->where('answer', 'LIKE', "%$request->keyword%")
       );

      return FaqResource::collection($faqs->get());
  }

  public function show(Faq $faq)
  {
      return new FaqResource($faq);
  }
}
