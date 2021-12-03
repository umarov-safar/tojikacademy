# Tojik Academy
## INSTRUCTION
* Create question category with slug `russian` and `english` for russian and English sentence page

* For deleting removed answer parent run cram for deleting not existing  parent
for example: 
```php
   $answers = \DB::table('answers')->where(
            ['answerable_type' => Answer::class],
            ['parent_id' => 'not null']
        )->get();

        foreach ($answers as $answer) {
            $parent = Answer::find($answer->parent_id);

            if(!$parent){
                Answer::destroy($answer->id);
            }
        }
```
