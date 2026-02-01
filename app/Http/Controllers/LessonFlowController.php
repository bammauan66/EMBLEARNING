class LessonFlowController extends Controller
{
    public function enter($lessonId)
    {
        // เช็ก post-test ว่าผ่านหรือยัง
        $passed = DB::table('scores')
            ->where('user_id', auth()->id())
            ->where('lesson_id', $lessonId)
            ->where('type', 'post')
            ->where('pass', 1)
            ->exists();

        if ($passed) {
            // ไปบทถัดไป
            return redirect('/lesson/' . ($lessonId + 1));
        }

        // ยังไม่ผ่าน → ต้องเริ่มที่ pretest
        return redirect("/lesson/$lessonId/pretest");
    }
}
