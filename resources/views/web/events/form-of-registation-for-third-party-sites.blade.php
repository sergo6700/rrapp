<form action="{{ route('registration.event.third-party-site')  }}" method="POST">
    <h4>Регистрация</h4>

    <div class="form-element-container">
        <input name="name" aria-label="ФИО" class="input" placeholder="ФИО *">
    </div>

    <div class="form-element-container">
        <input name="email" aria-label="E-mail" class="input" placeholder="E-mail *">
    </div>

    <div class="form-element-container">
        <input name="phone" aria-label="Телефон" class="input" placeholder="Телефон *">
    </div>

    <label for="radio-1-registration" class="checkbox-label">
        <input class="checkbox-input" value="agree-personal" type="checkbox" name="personalData" id="radio-1-registration">
        Я согласен на обработку персональных данных*
    </label>

    <label for="radio-2-registration" class="checkbox-label">
        <input class="checkbox-input" value="agree-rules" type="checkbox" name="siteRules" id="radio-2-registration">
        Я согласен с правилами пользования сайта*
    </label>

    <button type="submit" class="button button_rounded button_big button_brown popup-submit-button">
        <span class="text text_23 text_white text_PT-font">Регистрация</span>
    </button>

</form>


<style>
    h4 {
        padding-bottom: 55px;
        color: #562212;
        margin: 0;
        font-weight: 600;
        font-size: 28px;
        line-height: 32px;
    }
    .form-element-container {
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        -webkit-box-pack: justify;
        justify-content: space-between;
        margin-bottom: 5px;
        height: 86px;
    }
    .input {
        width: 100%;
        height: 60px;
        padding: 14px 24px;
        border: 1px solid #C9CCD4;
        font-size: 19px;
        line-height: 23px;
        font-family: "PT Sans", sans-serif;
        color: #000000;
        border-radius: 6px;
        -webkit-transition: border .3s;
        transition: border .3s;
    }
    button {
        width: 100%;
        margin-top: 38px;
        padding: 16px 10px 14px 10px;
        outline: none;
        display: inline-block;
        text-align: center;
        border: none;
        cursor: pointer;
        background-color: #C59368;
        border-radius: 6px;
    }
    button span {
        color: #FFFFFF;
        -webkit-transition: color .3s;
        transition: color .3s;
        font-family: "PT Sans", sans-serif;
        font-size: 23px;
        line-height: 30px;
        margin: 0;
    }
    .checkbox-label {
        display: -webkit-box;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        cursor: pointer;
        margin-top: 10px;
        margin-bottom: 15px;
        font-size: 19px;
        line-height: 32px;
        font-family: "PT Sans", sans-serif;
    }
    .custom-checkbox {
        position: relative;
        z-index: 1;
        display: inline-block;
        width: 25px;
        min-width: 25px;
        height: 25px;
        margin-right: 16px;
        background-color: #FFFFFF;
        border-radius: 6px;
        border: 1px solid #C9CCD4;
        cursor: pointer;
    }
    .custom-checkbox input[type="checkbox"] {
        position: absolute;
        z-index: 2;
        margin: 0;
        cursor: pointer;
        outline: none;
        opacity: 0;
    }
</style>