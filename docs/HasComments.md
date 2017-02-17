# Commentable Trait

## Usage


### Setup a Model
``` php
<?php

namespace App;

use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasComments;
}
```

### Create a comment
``` php
$user = User::first();
$post = Post::first();

$comment = $post->comment([
    'body' => 'The Markdown Body',
    'body_html' => 'Markdown to HTML Body',
], $user);

dd($comment);
```

### Create a comment as a child of another comment (e.g. an answer)
``` php
$user = User::first();
$post = Post::first();

$parent = $post->comments->first();

$comment = $post->comment([
    'body' => 'The Markdown Body',
    'body_html' => 'Markdown to HTML Body',
], $user, $parent);

dd($comment);
```

### Update a comment
``` php
$comment = $post->updateComment(1, [
    'body' => 'New Body',
    'body_html' => 'New HTML Body',
]);
```

### Delete a comment
``` php
$post->deleteComment(1);
```

### Count comments an entity has
``` php
$post = Post::first();

dd($post->commentCount());
```

## Credits

- [Brian Faust](https://github.com/faustbrian)