<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 判断用户是否有权限进行此请求。 false 是要有权限才行
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 获取应用于请求的验证规则。
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts|max:10|string',
            'body' => 'required|string',
        ];
    }


    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '标题是必须的',
            'title.max' => '标题字符不能大于10个',
            'body.required'  => '内容是必须的',
        ];
    }


}
