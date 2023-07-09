@if (!in_array($animeId, $blacklist_animeIds))
              @if (!in_array($animeId, $minagelist))
                  <!-- aa -->
                  <!doctype html>
                  @if (Auth::check() && Auth::user()->theme === 'light')
                      <html lang="en">
                  @else
                      <html lang="en" data-bs-theme="dark">
                  @endif

                  <head>
                      <meta charset="utf-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1">
                      <title>Watch {{ $details->animeTitle }} - Episode {{ $episode_number }}</title>
                      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
                          rel="stylesheet"
                          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
                          crossorigin="anonymous">
                  </head>
                  <style>
                      .scrollable {
                          width: 435x;
                          height: 550px;
                          overflow-y: scroll;
                      }

                      .scrollable::-webkit-scrollbar {
                          width: 0px;
                      }
                  </style>

                  <body>
                      @include('layouts.navbar')
                      @if (isset($x))
                          <div style="padding-top: 15px;">
                              <ul
                                  style="display: flex;align-items: flex-start; justify-content: center; list-style: none;">
                                  <li>
                                      <div class="jendala-stream">
                                          <div class="ratio ratio-16x9">
                                              <iframe src="{{$embed}}"
                                                  title="{{ $details['animeTitle'] }}" allowfullscreen></iframe>
                                          </div>


                                          <h1>{{ $details->animeTitle }} </h1>
                                          <div class="genre-list">

                                              @php
                                                  $valueArray = explode(',', $details['genres']);
                                                  $colorArray = ['#abc4ff', '#e2e2e2', '#b8e0d2', '#eac4d5', '#fff1e6']; // Array hex colors
                                              @endphp

                                              @if (Auth::check() && Auth::user()->theme === 'light')
                                                  @foreach ($valueArray as $key => $genre)
                                                      @php
                                                          $modifiedString = str_replace('"', '', $genre);
                                                          $modifiedString = str_replace('[', '', $modifiedString);
                                                          $modifiedString = str_replace(']', '', $modifiedString);
                                                          $color = $colorArray[$key % count($colorArray)]; // Get color based on the index
                                                      @endphp

                                                      <a href="/en/genre/{{ str_word_count($modifiedString) > 1 ? str_replace(' ', '-', strtolower($modifiedString)) : strtolower($modifiedString) }}/1"
                                                          class="btn btn-sm"
                                                          style="background-color: {{ $color }};">
                                                          {{ $modifiedString }}
                                                      </a>
                                                  @endforeach
                                              @else
                                                  @foreach ($valueArray as $key => $genre)
                                                      @php
                                                          $modifiedString = str_replace('"', '', $genre);
                                                          $modifiedString = str_replace('[', '', $modifiedString);
                                                          $modifiedString = str_replace(']', '', $modifiedString);
                                                          $color = $colorArray[$key % count($colorArray)]; // Get color based on the index
                                                      @endphp

                                                      <a href="/en/genre/{{ str_word_count($modifiedString) > 1 ? str_replace(' ', '-', strtolower($modifiedString)) : strtolower($modifiedString) }}/1"
                                                          class="btn btn-success btn-sm">{{ $modifiedString }}
                                                      </a>
                                                  @endforeach

                                              @endif



                                          </div>
                                          <div style="padding-top: 15px;">
                                              <div class="sinopsis"style='width: 1056px;'>
                                                  @if (Auth::check() && Auth::user()->theme === 'light')
                                                      <div class="alert alert-light" role="alert">
                                                      @else
                                                          <div class="alert alert-dark" role="alert">
                                                  @endif
                                                  {{ $details['synopsis'] }}
                                              </div>
                                          </div>

                                          <form id="commentForm" action="/add-comment" method="POST">

                                              <div class="Comments" style="max-width: 1056px;">
                                                  <div class="card">
                                                      <div class="p-2">
                                                          <h5 style="padding-left: 15px; padding-top: 15px">Comments
                                                          </h5>
                                                          <div
                                                              class="mt-2 d-flex flex-row align-items-center p-3 form-color">
                                                              <img src="https://www.asiamediajournal.com/wp-content/uploads/2022/11/Best-Default-PFP.png"
                                                                  width="40" height="40"
                                                                  class="rounded-circle mr-2">
                                                              <div style="width: 20px;"></div>
                                                              <input type="text" class="form-control"
                                                                  placeholder="Enter your comment..." name="comment">
                                                              <input type="hidden" class="form-control"
                                                                  placeholder="Enter your comment..."
                                                                  value="{{ Auth::user()->name }}" name="username">
                                                              <input type="hidden" class="form-control"
                                                                  placeholder="Enter your comment..."
                                                                  value="{{ Auth::user()->role }}" name="role">
                                                              <input type="hidden" class="form-control" value="{{ $x }}" name="episodeId">
                                                              <input type="hidden" class="form-control"
                                                                  placeholder="Enter your comment..."
                                                                  value="{{ date('Y-m-d H:i:s') }}" name="at">
                                                              <div style="width:5px;"></div>
                                                              @if (Auth::check() && Auth::user()->theme === 'light')
                                                                  <button class="btn btn-primary" type="submit"><svg
                                                                          xmlns="http://www.w3.org/2000/svg"
                                                                          width="16" height="16"
                                                                          fill="currentColor" class="bi bi-send-fill"
                                                                          viewBox="0 0 16 16">
                                                                          <path
                                                                              d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                                                      </svg></button>
                                                              @else
                                                                  <button class="btn btn-success" type="submit"><svg
                                                                          xmlns="http://www.w3.org/2000/svg"
                                                                          width="16" height="16"
                                                                          fill="currentColor" class="bi bi-send-fill"
                                                                          viewBox="0 0 16 16">
                                                                          <path
                                                                              d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                                                      </svg></button>
                                                              @endif

                                          </form>
                                      </div>
                                      <div class="mt-2">
                                          @foreach ($comments as $comment)
                                              <div class="d-flex flex-row">
                                                  <div class="p-2">
                                                  </div>
                                                  <img src="https://www.asiamediajournal.com/wp-content/uploads/2022/11/Best-Default-PFP.png"
                                                      width="40" height="40" class="rounded-circle mr-3">
                                                  <div style="width: 20px;"></div>
                                                  <div class="w-100">
                                                      <div class="d-flex justify-content-between align-items-center">
                                                          <h6>{{ $comment['username'] }}

                                                              @if ($comment['role'] === 'admin')
                                                                  <span class="badge bg-primary">Admin</span>
                                                              @elseif($comment['role'] === 'superadmin')
                                                                  <span class="badge bg-danger">Superadmin</span>
                                                              @endif


                                                              @if (Auth::user()->name == $comment['username'])
                                                                  <a type="button" data-bs-toggle="modal"
                                                                      data-bs-target="#staticBackdrop_{{ $comment['id'] }}">
                                                                      <svg xmlns="http://www.w3.org/2000/svg"
                                                                          width="16" height="16"
                                                                          fill="currentColor" class="bi bi-pencil"
                                                                          viewBox="0 0 16 16">
                                                                          <path
                                                                              d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                      </svg>
                                                                  </a>

                                                                  <!-- Modal -->
                                                                  <div class="modal fade"
                                                                      id="staticBackdrop_{{ $comment['id'] }}"
                                                                      data-bs-backdrop="static"
                                                                      data-bs-keyboard="false" tabindex="-1"
                                                                      aria-labelledby="staticBackdropLabel"
                                                                      aria-hidden="true">
                                                                      <div class="modal-dialog modal-dialog-centered">
                                                                          <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                  <h5 class="modal-title"
                                                                                      id="staticBackdropLabel">Edit
                                                                                      Comment</h5>
                                                                                  <button type="button"
                                                                                      class="btn-close"
                                                                                      data-bs-dismiss="modal"
                                                                                      aria-label="Close"></button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                  <div class="form-floating">
                                                                                      <textarea class="form-control" placeholder="Leave a comment here" id="inputValue{{ $comment['id'] }}">{{ $comment['comment'] }}</textarea>
                                                                                      <label
                                                                                          for="inputValue{{ $comment['id'] }}">Comments</label>
                                                                                  </div>

                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                  <button type="button"
                                                                                      class="btn"
                                                                                      data-bs-dismiss="modal">Cancel</button>
                                                                                  <a id="editLink{{ $comment['id'] }}"
                                                                                      href="/edit-comment?id={{ $comment['id'] }}&update=">
                                                                                      @if (Auth::check() && Auth::user()->theme === 'light')
                                                                                          <button type="button"
                                                                                              class="btn btn-dark">Submit</button>
                                                                                      @else
                                                                                          <button type="button"
                                                                                              class="btn btn-light">Submit</button>
                                                                                      @endif

                                                                                  </a>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <script>
                                                                      var inputField{{ $comment['id'] }} = document.getElementById('inputValue{{ $comment['id'] }}');
                                                                      var editLink{{ $comment['id'] }} = document.getElementById('editLink{{ $comment['id'] }}');
                                                                      editLink{{ $comment['id'] }}.addEventListener('click', function() {
                                                                          var inputValue = inputField{{ $comment['id'] }}.value;
                                                                          editLink{{ $comment['id'] }}.href = "/edit-comment?id={{ $comment['id'] }}&update=" + inputValue;
                                                                      });
                                                                  </script>
                                                                  <!-- delete -->

                                                                  <a type="button" data-bs-toggle="modal"
                                                                      data-bs-target="#staticBackdrop2_{{ $comment['id'] }}"><svg
                                                                          xmlns="http://www.w3.org/2000/svg"
                                                                          width="16" height="16"
                                                                          fill="currentColor" class="bi bi-trash"
                                                                          viewBox="0 0 16 16">
                                                                          <path
                                                                              d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                                          <path
                                                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                                      </svg></a>

                                                                  <!-- Modal -->
                                                                  <div class="modal fade"
                                                                      id="staticBackdrop2_{{ $comment['id'] }}"
                                                                      data-bs-backdrop="static"
                                                                      data-bs-keyboard="false" tabindex="-1"
                                                                      aria-labelledby="staticBackdropLabel"
                                                                      aria-hidden="true">
                                                                      <div class="modal-dialog modal-dialog-centered">
                                                                          <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                  <h5 class="modal-title"
                                                                                      id="staticBackdropLabel">Comment
                                                                                      Delete Confirmation</h5>
                                                                                  <button type="button"
                                                                                      class="btn-close"
                                                                                      data-bs-dismiss="modal"
                                                                                      aria-label="Close"></button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                  <center>
                                                                                      <p>Sure want to delete this
                                                                                          comment ?</p>
                                                                                  </center>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                  <button type="button"
                                                                                      class="btn btn-secondary"
                                                                                      data-bs-dismiss="modal">Cancel</button>
                                                                                  <a
                                                                                      href="/del-comment?id={{ $comment['id'] }}"><button
                                                                                          type="button"
                                                                                          class="btn btn-danger">Yes</button></a>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              @endif

                                                          </h6>


                                                          <p style="padding-right: 20px;">
                                                              @php
                                                                  $timestamp = strtotime($comment['at']);
                                                                  $current_time = time();
                                                                  $elapsed_time = $current_time - $timestamp;
                                                                  
                                                                  if ($elapsed_time < 60) {
                                                                      $result = $elapsed_time . ' seconds ago';
                                                                  } elseif ($elapsed_time < 3600) {
                                                                      $result = floor($elapsed_time / 60) . ' minutes ago';
                                                                  } elseif ($elapsed_time < 86400) {
                                                                      $result = floor($elapsed_time / 3600) . ' hours ago';
                                                                  } else {
                                                                      $result = floor($elapsed_time / 86400) . ' days ago';
                                                                  }
                                                              @endphp

                                                              @if ($comment['edited'] === 'yes')
                                                                  edited
                                                              @endif
                                                              {{ $result }}
                                                          </p>
                                                      </div>
                                                      <p>{{ $comment['comment'] }}</p>
                                                  </div>
                                              </div>
                                          @endforeach
                                      </div>
                          </div>
                          </div>
                          </div>
                          </form>

                          </li>
                          <li>
                              <h2 style="padding-left: 35px;">Episode List</h2>
                              <ul>


                                  @if (count($episode) >= 65)
                                      <div class="scrollable">
                                  @endif

                                  @foreach ($episode as $key => $episodes)
                                      @if ($episodes['episodeNum'] == $episode_number)
                                          @if (Auth::check() && Auth::user()->theme === 'light')
                                              <a href="#" class="btn btn-primary"
                                                  style="width: 75px;">{{ $episodes['episodeNum'] }}</a>
                                          @else
                                              <a href="#" class="btn btn-success"
                                                  style="width: 75px;">{{ $episodes['episodeNum'] }}</a>
                                          @endif
                                      @else
                                          @if (Auth::check() && Auth::user()->theme === 'light')
                                              <a href="/en/watch/{{ $episodes['episodeId'] }}" class="btn"
                                                  style="color:#31302E; width:75px; background-color: #f0f0f0;">{{ $episodes['episodeNum'] }}</a>
                                          @else
                                              <a href="/en/watch/{{ $episodes['episodeId'] }}"
                                                  class="btn btn-secondary"
                                                  style="width: 75px;">{{ $episodes['episodeNum'] }}</a>
                                          @endif
                                      @endif

                                      @if (($key + 1) % 5 == 0)
                                          <div style="padding-bottom: 5px;"></div>
                                      @endif
                                  @endforeach

                                  @if (count($episode) >= 65)
                                      </div>
                                  @endif

                                  @if (count($recs) > 1)
                                      <h2 style="padding-top: 15px; padding-bottom: 15px;">Rekomendasi</h2>
                                  @endif
                                  @foreach ($recs as $rek)
                                      @if ($rek->animeTitle != $details->animeTitle)
                                          <div class="card mb-3" style="max-width: 540px;">
                                              <div class="row g-0">
                                                  <div class="col-md-4">
                                                      <a
                                                          href="{{ route('userAnimeDtls', ['anime' => $rek->animeId]) }}"><img
                                                              src="{{ $rek->animeImg }}"
                                                              class="img-fluid rounded-start"></a>
                                                  </div>
                                                  <div class="col-md-8">
                                                      <div class="card-body">
                                                          <h5 class="card-title">{{ $rek->animeTitle }}</h5>
                                                          <p class="card-text"
                                                              style="display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                                              {{ $rek->synopsis }}</p>
                                                          <p class="card-text"><small
                                                                  class="text-body-secondary">Released on
                                                                  {{ $rek->releasedDate }}</small></p>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      @endif
                                  @endforeach




                          </li>
                          </ul>
                          </div>
                      @endif


                      </ul>

                      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
                          integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
                      </script>
                  </body>

                  </html>


                  <!-- aa -->
              @else
                  @php
                      $minAge = \App\Models\MinAge::where('animeId', $animeId)->value('minAge');
                  @endphp
                  @if ($age > $minAge)
                      <!-- aa -->

                      <!doctype html>
                      @if (Auth::check() && Auth::user()->theme === 'light')
                          <html lang="en">
                      @else
                          <html lang="en" data-bs-theme="dark">
                      @endif

                      <head>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1">
                          <title>Watch {{ $details->animeTitle }} - Episode {{ $episode_number }}</title>
                          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
                              rel="stylesheet"
                              integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
                              crossorigin="anonymous">
                      </head>
                      <style>
                          .scrollable {
                              width: 435x;
                              height: 550px;
                              overflow-y: scroll;
                          }

                          .scrollable::-webkit-scrollbar {
                              width: 0px;
                          }
                      </style>

                      <body>
                          @include('layouts.navbar')
                          @if (isset($x))
                              <div style="padding-top: 15px;">
                                  <ul
                                      style="display: flex;align-items: flex-start; justify-content: center; list-style: none;">
                                      <li>
                                          <div class="jendala-stream">
                                              <div class="ratio ratio-16x9">
                                                  <iframe src="{{$embed}}"
                                                      title="{{ $details['animeTitle'] }}" allowfullscreen></iframe>
                                              </div>


                                              <h1>{{ $details->animeTitle }} </h1>
                                              <div class="genre-list">

                                                  @php
                                                      $valueArray = explode(',', $details['genres']);
                                                      $colorArray = ['#abc4ff', '#e2e2e2', '#b8e0d2', '#eac4d5', '#fff1e6']; // Array hex colors
                                                  @endphp

                                                  @if (Auth::check() && Auth::user()->theme === 'light')
                                                      @foreach ($valueArray as $key => $genre)
                                                          @php
                                                              $modifiedString = str_replace('"', '', $genre);
                                                              $modifiedString = str_replace('[', '', $modifiedString);
                                                              $modifiedString = str_replace(']', '', $modifiedString);
                                                              $color = $colorArray[$key % count($colorArray)]; // Get color based on the index
                                                          @endphp

                                                          <a href="/en/genre/{{ str_word_count($modifiedString) > 1 ? str_replace(' ', '-', strtolower($modifiedString)) : strtolower($modifiedString) }}/1"
                                                              class="btn btn-sm"
                                                              style="background-color: {{ $color }};">
                                                              {{ $modifiedString }}
                                                          </a>
                                                      @endforeach
                                                  @else
                                                      @foreach ($valueArray as $key => $genre)
                                                          @php
                                                              $modifiedString = str_replace('"', '', $genre);
                                                              $modifiedString = str_replace('[', '', $modifiedString);
                                                              $modifiedString = str_replace(']', '', $modifiedString);
                                                              $color = $colorArray[$key % count($colorArray)]; // Get color based on the index
                                                          @endphp

                                                          <a href="/en/genre/{{ str_word_count($modifiedString) > 1 ? str_replace(' ', '-', strtolower($modifiedString)) : strtolower($modifiedString) }}/1"
                                                              class="btn btn-success btn-sm">{{ $modifiedString }}
                                                          </a>
                                                      @endforeach

                                                  @endif



                                              </div>
                                              <div style="padding-top: 15px;">
                                                  <div class="sinopsis"style='width: 1056px;'>
                                                      @if (Auth::check() && Auth::user()->theme === 'light')
                                                          <div class="alert alert-light" role="alert">
                                                          @else
                                                              <div class="alert alert-dark" role="alert">
                                                      @endif
                                                      {{ $details['synopsis'] }}
                                                  </div>
                                              </div>

                                              <form id="commentForm" action="/add-comment" method="POST">

                                                  <div class="Comments" style="max-width: 1056px;">
                                                      <div class="card">
                                                          <div class="p-2">
                                                              <h5 style="padding-left: 15px; padding-top: 15px">
                                                                  Comments</h5>
                                                              <div
                                                                  class="mt-2 d-flex flex-row align-items-center p-3 form-color">
                                                                  <img src="https://www.asiamediajournal.com/wp-content/uploads/2022/11/Best-Default-PFP.png"
                                                                      width="40" height="40"
                                                                      class="rounded-circle mr-2">
                                                                  <div style="width: 20px;"></div>
                                                                  <input type="text" class="form-control"
                                                                      placeholder="Enter your comment..."
                                                                      name="comment">
                                                                  <input type="hidden" class="form-control"
                                                                      placeholder="Enter your comment..."
                                                                      value="{{ Auth::user()->name }}"
                                                                      name="username">
                                                                  <input type="hidden" class="form-control"
                                                                      placeholder="Enter your comment..."
                                                                      value="{{ Auth::user()->role }}"
                                                                      name="role">
                                                                  <input type="hidden" class="form-control"
                                                                      placeholder="Enter your comment..."
                                                                      value="{{ $x }}" name="episodeId">
                                                                  <input type="hidden" class="form-control"
                                                                      placeholder="Enter your comment..."
                                                                      value="{{ date('Y-m-d H:i:s') }}"
                                                                      name="at">
                                                                  <div style="width:5px;"></div>
                                                                  @if (Auth::check() && Auth::user()->theme === 'light')
                                                                      <button class="btn btn-primary"
                                                                          type="submit"><svg
                                                                              xmlns="http://www.w3.org/2000/svg"
                                                                              width="16" height="16"
                                                                              fill="currentColor"
                                                                              class="bi bi-send-fill"
                                                                              viewBox="0 0 16 16">
                                                                              <path
                                                                                  d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                                                          </svg></button>
                                                                  @else
                                                                      <button class="btn btn-success"
                                                                          type="submit"><svg
                                                                              xmlns="http://www.w3.org/2000/svg"
                                                                              width="16" height="16"
                                                                              fill="currentColor"
                                                                              class="bi bi-send-fill"
                                                                              viewBox="0 0 16 16">
                                                                              <path
                                                                                  d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                                                          </svg></button>
                                                                  @endif

                                              </form>
                                          </div>
                                          <div class="mt-2">
                                              @foreach ($comments as $comment)
                                                  <div class="d-flex flex-row">
                                                      <div class="p-2">
                                                      </div>
                                                      <img src="https://www.asiamediajournal.com/wp-content/uploads/2022/11/Best-Default-PFP.png"
                                                          width="40" height="40" class="rounded-circle mr-3">
                                                      <div style="width: 20px;"></div>
                                                      <div class="w-100">
                                                          <div
                                                              class="d-flex justify-content-between align-items-center">
                                                              <h6>{{ $comment['username'] }}

                                                                  @if ($comment['role'] === 'admin')
                                                                      <span class="badge bg-primary">Admin</span>
                                                                  @elseif($comment['role'] === 'superadmin')
                                                                      <span class="badge bg-danger">Superadmin</span>
                                                                  @endif


                                                                  @if (Auth::user()->name == $comment['username'])
                                                                      <a type="button" data-bs-toggle="modal"
                                                                          data-bs-target="#staticBackdrop_{{ $comment['id'] }}">
                                                                          <svg xmlns="http://www.w3.org/2000/svg"
                                                                              width="16" height="16"
                                                                              fill="currentColor" class="bi bi-pencil"
                                                                              viewBox="0 0 16 16">
                                                                              <path
                                                                                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                                          </svg>
                                                                      </a>

                                                                      <!-- Modal -->
                                                                      <div class="modal fade"
                                                                          id="staticBackdrop_{{ $comment['id'] }}"
                                                                          data-bs-backdrop="static"
                                                                          data-bs-keyboard="false" tabindex="-1"
                                                                          aria-labelledby="staticBackdropLabel"
                                                                          aria-hidden="true">
                                                                          <div
                                                                              class="modal-dialog modal-dialog-centered">
                                                                              <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                      <h5 class="modal-title"
                                                                                          id="staticBackdropLabel">Edit
                                                                                          Comment</h5>
                                                                                      <button type="button"
                                                                                          class="btn-close"
                                                                                          data-bs-dismiss="modal"
                                                                                          aria-label="Close"></button>
                                                                                  </div>
                                                                                  <div class="modal-body">
                                                                                      <div class="form-floating">
                                                                                          <textarea class="form-control" placeholder="Leave a comment here" id="inputValue{{ $comment['id'] }}">{{ $comment['comment'] }}</textarea>
                                                                                          <label
                                                                                              for="inputValue{{ $comment['id'] }}">Comments</label>
                                                                                      </div>

                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                      <button type="button"
                                                                                          class="btn"
                                                                                          data-bs-dismiss="modal">Cancel</button>
                                                                                      <a id="editLink{{ $comment['id'] }}"
                                                                                          href="/edit-comment?id={{ $comment['id'] }}&update=">
                                                                                          @if (Auth::check() && Auth::user()->theme === 'light')
                                                                                              <button type="button"
                                                                                                  class="btn btn-dark">Submit</button>
                                                                                          @else
                                                                                              <button type="button"
                                                                                                  class="btn btn-light">Submit</button>
                                                                                          @endif

                                                                                      </a>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <script>
                                                                          var inputField{{ $comment['id'] }} = document.getElementById('inputValue{{ $comment['id'] }}');
                                                                          var editLink{{ $comment['id'] }} = document.getElementById('editLink{{ $comment['id'] }}');
                                                                          editLink{{ $comment['id'] }}.addEventListener('click', function() {
                                                                              var inputValue = inputField{{ $comment['id'] }}.value;
                                                                              editLink{{ $comment['id'] }}.href = "/edit-comment?id={{ $comment['id'] }}&update=" + inputValue;
                                                                          });
                                                                      </script>
                                                                      <!-- delete -->

                                                                      <a type="button" data-bs-toggle="modal"
                                                                          data-bs-target="#staticBackdrop2_{{ $comment['id'] }}"><svg
                                                                              xmlns="http://www.w3.org/2000/svg"
                                                                              width="16" height="16"
                                                                              fill="currentColor" class="bi bi-trash"
                                                                              viewBox="0 0 16 16">
                                                                              <path
                                                                                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                                              <path
                                                                                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                                          </svg></a>

                                                                      <!-- Modal -->
                                                                      <div class="modal fade"
                                                                          id="staticBackdrop2_{{ $comment['id'] }}"
                                                                          data-bs-backdrop="static"
                                                                          data-bs-keyboard="false" tabindex="-1"
                                                                          aria-labelledby="staticBackdropLabel"
                                                                          aria-hidden="true">
                                                                          <div
                                                                              class="modal-dialog modal-dialog-centered">
                                                                              <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                      <h5 class="modal-title"
                                                                                          id="staticBackdropLabel">
                                                                                          Comment Delete Confirmation
                                                                                      </h5>
                                                                                      <button type="button"
                                                                                          class="btn-close"
                                                                                          data-bs-dismiss="modal"
                                                                                          aria-label="Close"></button>
                                                                                  </div>
                                                                                  <div class="modal-body">
                                                                                      <center>
                                                                                          <p>Sure want to delete this
                                                                                              comment ?</p>
                                                                                      </center>
                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                      <button type="button"
                                                                                          class="btn btn-secondary"
                                                                                          data-bs-dismiss="modal">Cancel</button>
                                                                                      <a
                                                                                          href="/del-comment?id={{ $comment['id'] }}"><button
                                                                                              type="button"
                                                                                              class="btn btn-danger">Yes</button></a>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  @endif

                                                              </h6>


                                                              <p style="padding-right: 20px;">
                                                                  @php
                                                                      $timestamp = strtotime($comment['at']);
                                                                      $current_time = time();
                                                                      $elapsed_time = $current_time - $timestamp;
                                                                      
                                                                      if ($elapsed_time < 60) {
                                                                          $result = $elapsed_time . ' seconds ago';
                                                                      } elseif ($elapsed_time < 3600) {
                                                                          $result = floor($elapsed_time / 60) . ' minutes ago';
                                                                      } elseif ($elapsed_time < 86400) {
                                                                          $result = floor($elapsed_time / 3600) . ' hours ago';
                                                                      } else {
                                                                          $result = floor($elapsed_time / 86400) . ' days ago';
                                                                      }
                                                                  @endphp

                                                                  @if ($comment['edited'] === 'yes')
                                                                      edited
                                                                  @endif
                                                                  {{ $result }}
                                                              </p>
                                                          </div>
                                                          <p>{{ $comment['comment'] }}</p>
                                                      </div>
                                                  </div>
                                              @endforeach
                                          </div>
                              </div>
                              </div>
                              </div>
                              </form>

                              </li>
                              <li>
                                  <h2 style="padding-left: 35px;">Episode List</h2>
                                  <ul>


                                      @if (count($episode) >= 65)
                                          <div class="scrollable">
                                      @endif

                                      @foreach ($episode as $key => $episodes)
                                          @if ($episodes['episodeNum'] == $episode_number)
                                              @if (Auth::check() && Auth::user()->theme === 'light')
                                                  <a href="#" class="btn btn-primary"
                                                      style="width: 75px;">{{ $episodes['episodeNum'] }}</a>
                                              @else
                                                  <a href="#" class="btn btn-success"
                                                      style="width: 75px;">{{ $episodes['episodeNum'] }}</a>
                                              @endif
                                          @else
                                              @if (Auth::check() && Auth::user()->theme === 'light')
                                                  <a href="/en/watch/{{ $episodes['episodeId'] }}" class="btn"
                                                      style="color:#31302E; width:75px; background-color: #f0f0f0;">{{ $episodes['episodeNum'] }}</a>
                                              @else
                                                  <a href="/en/watch/{{ $episodes['episodeId'] }}"
                                                      class="btn btn-secondary"
                                                      style="width: 75px;">{{ $episodes['episodeNum'] }}</a>
                                              @endif
                                          @endif

                                          @if (($key + 1) % 5 == 0)
                                              <div style="padding-bottom: 5px;"></div>
                                          @endif
                                      @endforeach

                                      @if (count($episode) >= 65)
                                          </div>
                                      @endif

                                      @if (count($recs) > 1)
                                          <h2 style="padding-top: 15px; padding-bottom: 15px;">Rekomendasi</h2>
                                      @endif
                                      @foreach ($recs as $rek)
                                          @if ($rek->animeTitle != $details->animeTitle)
                                              <div class="card mb-3" style="max-width: 540px;">
                                                  <div class="row g-0">
                                                      <div class="col-md-4">
                                                          <a
                                                              href="{{ route('userAnimeDtls', ['anime' => $rek->animeId]) }}"><img
                                                                  src="{{ $rek->animeImg }}"
                                                                  class="img-fluid rounded-start"></a>
                                                      </div>
                                                      <div class="col-md-8">
                                                          <div class="card-body">
                                                              <h5 class="card-title">{{ $rek->animeTitle }}</h5>
                                                              <p class="card-text"
                                                                  style="display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                                                  {{ $rek->synopsis }}</p>
                                                              <p class="card-text"><small
                                                                      class="text-body-secondary">Released on
                                                                      {{ $rek->releasedDate }}</small></p>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          @endif
                                      @endforeach




                              </li>
                              </ul>
                              </div>
                          @endif


                          </ul>

                          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
                              integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
                          </script>
                      </body>

                      </html>



                      <!-- aa -->
                  @else
                      <!doctype html>
                      @if (Auth::check() && Auth::user()->theme === 'light')
                          <html lang="en">
                      @else
                          <html lang="en" data-bs-theme="dark">
                      @endif

                      <head>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1">
                          <title>Bootstrap demo</title>
                          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
                              rel="stylesheet"
                              integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
                              crossorigin="anonymous">
                          <style>
                              .kartu {
                                  position: relative;
                                  display: inline-block;
                              }

                              .badge {
                                  position: absolute;
                                  top: 7px;
                                  left: 7px;
                                  background-color: #007bff;
                                  color: #fff;
                                  font-weight: bold;
                                  z-index: 1;
                              }
                          </style>
                      </head>

                      <body>
                          <center>
                              <p style="padding-top: 40vh;">"It seems we can't find the anime you're looking for."</p>
                              @if (Auth::check() && Auth::user()->theme === 'light')
                                  <a class="btn btn-dark" href="/">Browse Some Anime</a>
                              @else
                                  <a class="btn btn-light" href="/">Browse Some Anime</a>
                              @endif

                          </center>
                          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                              integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
                          </script>
                      </body>

                      </html>

                  @endif

              @endif

              <!-- aa -->
          @else
              <!doctype html>
              @if (Auth::check() && Auth::user()->theme === 'light')
                  <html lang="en">
              @else
                  <html lang="en" data-bs-theme="dark">
              @endif

              <head>
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1">
                  <title>Bootstrap demo</title>
                  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
                      rel="stylesheet"
                      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
                      crossorigin="anonymous">
                  <style>
                      .kartu {
                          position: relative;
                          display: inline-block;
                      }

                      .badge {
                          position: absolute;
                          top: 7px;
                          left: 7px;
                          background-color: #007bff;
                          color: #fff;
                          font-weight: bold;
                          z-index: 1;
                      }
                  </style>
              </head>

              <body>
                  <center>
                      <p style="padding-top: 40vh;">"It seems we can't find the anime you're looking for."</p>
                      @if (Auth::check() && Auth::user()->theme === 'light')
                          <a class="btn btn-dark" href="/">Browse Some Anime</a>
                      @else
                          <a class="btn btn-light" href="/">Browse Some Anime</a>
                      @endif

                  </center>
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
                  </script>
              </body>

              </html>


          @endif
