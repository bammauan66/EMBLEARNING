<x-app-layout>
    <x-slot name="header">
        <h2>บทเรียนการใช้งานโปรแกรม Wilcom เบื้องต้น</h2>
    </x-slot>

    <div class="p-6">
        <ol>
            @foreach($lessons as $lesson)
                <li>
                    <a href="{{ route('lessons.show', $lesson->id) }}">
                        {{ $lesson->title }}
                    </a>
                </li>
            @endforeach
        </ol>
    </div>
</x-app-layout>
