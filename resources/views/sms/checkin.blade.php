{!! $msg !!}
<?php if (isset($answers) && !empty($answers)): ?>Reply with<?php if (isset($keyword)): ?> "{{$keyword}}" and include<?php endif; ?> @foreach ($answers as $answer)"{!!$answer['answer']!!}"<?php if ($loop->remaining == 1): ?> or <?php elseif (!$loop->last): ?>, <?php endif; ?>@endforeach in your response<?php if (isset($check_in_url)): ?>, or go to: {{ $check_in_url }}<?php endif; ?><?php endif; ?>
