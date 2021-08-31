@extends('layout.app')

@section('title', 'Студенты')

@section('content')
    <section class="section">
        <div class="section__wrapper">
            <div class="section__container">
                <div class="section__form-wrapper">
                    <form class="section__form form" id="create-student" action="index.php?method=addStudent" method="post">
                        <div class="form__wrapper">
                            <h2 class="form_title">Форма добавления ученика</h2>
                            <input class="form__input" type="text" name="SLastName" required="required" placeholder="Фамилия">
                            <input class="form__input" type="text" name="SFirstName" required="required" placeholder="Имя">
                            <input class="form__input" type="text" name="SMidName" required="required" placeholder="Отчество">
                            <input class="form__input" type="text" name="SBirthDate" required="required" placeholder="Дата рождения (yyyy-mm-dd)">
                            <div class="form__select-block select">
                                <h4 class="select__title">Выберете класс:</h4>
                                <select class="select__form-select" name="CId">
                                    @foreach ($resultAllClasses as $class)
                                        <option> {{$class[0]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="form__btn" type="submit">Добавить</button>
                        </div>
                    </form>
                    <a class="section__btn-logout" href="?method=logout">Выход</a>
                </div>
                <div class="section__info-block-students">
                    <div class="section__table">
                        <div class="section__table-block">
                            @forelse ($queryAllStudents as $class => $students)
                                <div class="section__main-block">
                                    <div class="section__class-title">
                                        <p>Класс: {{$class}} </p>
                                        <button class="section__class-title_btn">
                                            <img class="right-arrow" src="../resources/img/right-arrow.png" alt="right-arrow">
                                        </button>
                                    </div>
                                    <table class="section__table-content">
                                        <tr>
                                            <th>Фамилия</th>
                                            <th>Имя</th>
                                            <th>Отчество</th>
                                            <th>Дата рождения</th>
                                            <th>Класс</th>
                                            <th>Удалить</th>
                                        </tr>
                                        @foreach ($students as $attribute => $student)
                                            <p style="display: none">{{$_POST['SId'] = $student['SId']}}</p>
                                            <tr>
                                                <td> {{$student['SLastName']}}</td>
                                                <td> {{$student['SFirstName']}}</td>
                                                <td> {{$student['SMidName']}}</td>
                                                <td> {{$student['SBirthDate']}}</td>
                                                <td> {{$student['CClass']}}</td>
                                                <td><a class="delete-btn" onclick="return confirm('Вы уверены, что хотите удалить запись?')" href="index.php?method=delete&SId={{$_POST['SId']}}">
                                                        <img class="delete-img" src="../resources/img/delete.png" alt="delete">
                                                    </a></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @empty
                                <p class="message">Нет пользователей</p>
                            @endforelse
                        </div>
                    </div>
                    <div class="section__table query">
                        <div class="section__table-block query__block">
                            <h3 class="query__block-title">Самый младший ученик среди всех классов:</h3>
                            @foreach ($queryByMinBirthDate as $class => $student)
                                @foreach ( $student as $attribute => $item)
                                    <table>
                                        <tr>
                                            <th>Фамилия</th>
                                            <th>Имя</th>
                                            <th>Отчество</th>
                                            <th>Дата рождения</th>
                                            <th>Класс</th>
                                        </tr>
                                        <tr>
                                            <td>{{$item['SLastName']}}</td>
                                            <td>{{$item['SFirstName']}}</td>
                                            <td>{{$item['SMidName']}}</td>
                                            <td>{{$item['SBirthDate']}}</td>
                                            <td>{{$item['CClass']}}</td>
                                        </tr>
                                    </table>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div class="section__table query">
                        <div class="section__table-block query__block">
                            <h3 class="query__block-title">Количество учеников в 10 В классе:</h3>
                            <p class="query__block-count">{{count($queryStudentsByClass)}}</p>
                        </div>
                    </div>
                    <div class="section__table query">
                        <div class="section__table-block query__block">
                            <h3 class="query__block-title">Ученики, родившиеся в июле:</h3>
                            <table>
                                @forelse ($queryStudentsByMonth as $studentMonth)
                                    <tr>
                                        <th>Имя</th>
                                        <th>Фамилия</th>
                                        <th>Отчество</th>
                                        <th>Дата рождения</th>
                                    </tr>
                                    <tr>
                                        <td>{{$studentMonth[1]}}</td>
                                        <td>{{$studentMonth[2]}}</td>
                                        <td>{{$studentMonth[3]}}</td>
                                        <td>{{$studentMonth[4]}}</td>
                                    </tr>
                                @empty
                                    <p class="message">Нет пользователей</p>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection