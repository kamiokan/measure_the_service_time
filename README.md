# CakePHP3.8 施術時間を計測する機能のプロトタイプ的なもの


A measure_the_service_time applications with [CakePHP](https://cakephp.org) 3.8.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## 画面

###1. 予約一覧の画面
![schedules_display](https://user-images.githubusercontent.com/25732571/63008227-24fa7180-bebd-11e9-8949-33fc3f54c201.png)

###2. 接客時間一覧の画面 
![service_time_display](https://user-images.githubusercontent.com/25732571/63008209-1dd36380-bebd-11e9-9eda-dd6b3328bbd7.png)

## Todo
- 開始時間と終了時間を確定後に編集する機能を追加
- 接客時間レコードの削除機能
- 接客時間が5時間以上のものを異常値として検知するバリデーション
- 終了時間 < 開始時間 を許さないバリデーション
