<template>
    <div class="container" >
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Laravel Page</div>

                    <div class="panel-body">
                        我是一个实例组件
                        <el-button type="primary">哈哈哈 this is element 按钮</el-button>
                        <i class="el-icon-back"></i>
                        <el-radio v-model="radio" label="1">备选项</el-radio>
                        <el-radio v-model="radio" label="2">备选项</el-radio>
                        <el-input v-model="input" placeholder="请输入内容"></el-input>
                        <el-switch
                            v-model="switch2"
                            active-color="#13ce66"
                            inactive-color="#ff4949">
                        </el-switch>

                        <hr/>
                        <el-form :inline="true" :model="formInline" class="demo-form-inline">
                            <el-form-item label="审批人">
                                <el-input v-model="formInline.user" placeholder="审批人"></el-input>
                            </el-form-item>
                            <el-form-item label="活动区域">
                                <el-select v-model="formInline.region" placeholder="活动区域">
                                <el-option label="区域一" value="shanghai"></el-option>
                                <el-option label="区域二" value="beijing"></el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="onSubmit">查询</el-button>
                            </el-form-item>
                        </el-form>

                        <el-tag type="danger">Tag标签</el-tag>
                        <el-button type="primary"  @click="loading" v-loading.fullscreen.lock="fullscreenLoading">Loading加载</el-button>
                    </div>

                    <!--传统方式 遍历数据 渲染表格-->
                    <div class="table-responsive" id="user-table">
                        <table class="table table-striped table-bordered table-style  table-nbacfg table-responsive jambo_table bulk_action">
                            <thead>
                                <tr >
                                    <th class="column-title">ID </th>
                                    <th class="column-title">标题 </th>
                                    <th>内容</th>
                                    <th>创建时间</th>
                                    <th class="column-title">操作 </th>
                                </tr>
                            </thead>
                            <tbody id="table-list">
                                <tr v-for="post in posts" :key="post.id" >
                                    <td>{{post.id}}</td>
                                    <td>{{post.title}}</td>
                                    <td>{{post.body}}</td>
                                    <td>{{post.create_at}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" @click="showTableDialog(post)">编辑</button>
                                        <button type="button" class="btn btn-danger">删除</button>

                                        <el-button type="primary">这是element按钮上传</el-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!--Element 表格渲染  :data= 表格的对象数组  prop=对应对象中的键名即可填入数据  label = th属性来定义表格的列名-->
                        <el-table :data="posts" border style="width: 100%">
                            <el-table-column type="selection" width="35"> </el-table-column>
                            <el-table-column  prop="id" label="ID" width="40" type="index" :index="0">
                            </el-table-column>
                            <el-table-column  prop="title" label="标题" width="120">
                            </el-table-column>
                            <el-table-column  prop="body" label="内容" width="180">
                            </el-table-column>
                            <el-table-column prop="create_at" label="创建时间" width="180">
                            </el-table-column>
                            <el-table-column  label="操作" width="180">
                                <template slot-scope="scope">
                                    <el-button  @click="showTableDialog2(scope.$index,  scope.row)">编辑</el-button>
                                    <el-button  >删除</el-button>
                                </template>
                            </el-table-column>
                        </el-table>
                        <!--  start 表格多选  -->
                        <!-- <div style="margin-top: 20px">
                            <el-button @click="toggleSelection([posts])">全选</el-button>
                            <el-button @click="toggleSelection()">确定</el-button>
                        </div> -->
                        <!--  end 表格多选  -->
                        
                        <!--Element 表格渲染 -->
                        <!--Element 分页-->
                        <el-pagination background layout="total, prev, pager, next, jumper"  :total="total"   :page-size="pagesize"  
                            @size-change="initShow" 
                            @current-change="initShow">
                        </el-pagination>

                        <!-- Element 表单验证-->
                        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
                            <el-form-item label="活动名称" prop="name">
                                <el-input v-model="ruleForm.name"></el-input>
                            </el-form-item>
                            <el-form-item label="活动区域" prop="region">
                                <el-select v-model="ruleForm.region" placeholder="请选择活动区域">
                                <el-option label="区域一" value="shanghai"></el-option>
                                <el-option label="区域二" value="beijing"></el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="活动时间" required>
                                <el-col :span="11">
                                <el-form-item prop="date1">
                                    <el-date-picker type="date" placeholder="选择日期" v-model="ruleForm.date1" style="width: 100%;"></el-date-picker>
                                </el-form-item>
                                </el-col>
                                <el-col class="line" :span="2">-</el-col>
                                <el-col :span="11">
                                <el-form-item prop="date2">
                                    <el-time-picker type="fixed-time" placeholder="选择时间" v-model="ruleForm.date2" style="width: 100%;"></el-time-picker>
                                </el-form-item>
                                </el-col>
                            </el-form-item>
                            <el-form-item label="即时配送" prop="delivery">
                                <el-switch v-model="ruleForm.delivery"></el-switch>
                            </el-form-item>
                            <el-form-item label="活动性质" prop="type">
                                <el-checkbox-group v-model="ruleForm.type">
                                <el-checkbox label="美食/餐厅线上活动" name="type"></el-checkbox>
                                <el-checkbox label="地推活动" name="type"></el-checkbox>
                                <el-checkbox label="线下主题活动" name="type"></el-checkbox>
                                <el-checkbox label="单纯品牌曝光" name="type"></el-checkbox>
                                </el-checkbox-group>
                            </el-form-item>
                            <el-form-item label="特殊资源" prop="resource">
                                <el-radio-group v-model="ruleForm.resource">
                                <el-radio label="线上品牌商赞助"></el-radio>
                                <el-radio label="线下场地免费"></el-radio>
                                </el-radio-group>
                            </el-form-item>
                            <el-form-item label="活动形式" prop="desc">
                                <el-input type="textarea" v-model="ruleForm.desc"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submitForm('ruleForm')">立即创建</el-button>
                                <el-button @click="resetForm('ruleForm')">重置</el-button>
                            </el-form-item>
                        </el-form>

                        <!--MessageBox 弹框 确认消息 -->
                        <template>
                            <el-button type="text" @click="MessageBox">点击打开 Message Box</el-button>
                        </template>

                        <!-- Element Dialog对话框-->
                        <el-dialog title="Post 编辑" :visible.sync="dialogFormVisible"  width="40%">
                            <el-form :model="dialogEdit">
                                <el-form-item label="标题" :label-width="formLabelWidth">
                                    <el-input v-model="dialogEdit.title" auto-complete="off"></el-input>
                                </el-form-item>
                                <el-form-item label="活动区域" :label-width="formLabelWidth">
                                <el-select v-model="dialogEdit.region" placeholder="请选择活动区域">
                                    <el-option label="区域一" value="shanghai"></el-option>
                                    <el-option label="区域二" value="beijing"></el-option>
                                </el-select>
                                </el-form-item>
                                <el-form-item label="内容" :label-width="formLabelWidth">
                                    <el-input type="textarea" :rows="5" placeholder="请输入内容" v-model="dialogEdit.body">
                                    </el-input>
                                </el-form-item>
                            </el-form>
                            <div slot="footer" class="dialog-footer">
                                <el-button @click="dialogFormVisible = false">取 消</el-button>
                                <el-button type="primary" @click="edit">确 定</el-button>
                            </div>
                        </el-dialog>
                        <!-- Element Dialog对话框 -->

                        <!--测试一下github-->

                        <!--laravel 测试规则验证-->
                            
                        <el-form :inline="true" :model="formInline" class="demo-form-inline">
                            <el-form-item label="标题">
                                <el-input v-model="formInline.title" placeholder="标题"></el-input>
                            </el-form-item>
                            <el-form-item label="内容">
                                <el-input type="textarea"  placeholder="内容" v-model="formInline.body">
                                </el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="onSubmit">查询</el-button>
                            </el-form-item>
                        </el-form>

                        <!--laravel 测试规则验证-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .el-dialog .el-input__inner {
        width: 450px;
    }
    .el-dialog .el-textarea__inner {
        width: 450px;
    }
    /* body {
        margiin: 0;
    } */
</style>
<script>
    const str = 'abcdefghijklmn';
    export default {
        data() {
            return {
                posts: [],
                radio: '1',
                input: '123',
                str: str,
                switch1: true,
                switch2: true,
                formInline: {
                    user: '',
                    region: ''
                },
                total: 0,
                pagesize: 5,
                dialogFormVisible: false,
                dialogEdit: {
                    title: '',
                    name: '',
                    region: '',
                    body: ''
                },
                formLabelWidth: '120px',
                ruleForm: {
                    name: '',
                    region: '',
                    date1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    resource: '',
                    desc: ''
                },
                rules: {
                    name: [
                        { required: true, message: '请输入活动名称', trigger: 'blur' },
                        { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur' }
                    ],
                    region: [
                        { required: true, message: '请选择活动区域', trigger: 'change' }
                    ],
                    date1: [
                        { type: 'date', required: true, message: '请选择日期', trigger: 'change' }
                    ],
                    date2: [
                        { type: 'date', required: true, message: '请选择时间', trigger: 'change' }
                    ],
                    type: [
                        { type: 'array', required: true, message: '请至少选择一个活动性质', trigger: 'change' }
                    ],
                    resource: [
                        { required: true, message: '请选择活动资源', trigger: 'change' }
                    ],
                    desc: [
                        { required: true, message: '请填写活动形式', trigger: 'blur' }
                    ]
                },
                fullscreenLoading: false,
                formInline: {
                    title: '',
                    body: ''
                }
            }
        },
        mounted() {
            // console.log('Home 页面.')
            this.initShow(1);
        },
        methods: {
            loading() {
                // loading: true
                this.fullscreenLoading = true;
                setTimeout(() => {
                    this.fullscreenLoading = false;
                }, 2000);
            },
            onSubmit() {
                console.log('submit!');
                console.log(this.formInline.region);
                console.log(this.formInline.user);
            },
            initShow(pagenum) {
                // axios.post('/api/posts',{params:{pagenum:pagenum, pagesize:this.pagesize}}).then(res => { //get请求
                axios.post('/api/posts',{pagenum:pagenum, pagesize:this.pagesize}).then(res => { //post 请求
                    
                    console.log(res);
                    this.posts = res.data.list;
                    this.total = res.data.count;
                    console.log(this.posts);
                })
            },
            showTableDialog(params) { //绑定表单 弹框参数
                this.dialogFormVisible = true;
                console.log(params);
                this.dialogEdit = params;
            },
            showTableDialog2(index, row) { //绑定表单 弹框参数 Element表单获取的index是表单的索引  row是表单一行的数据
                this.dialogFormVisible = true;
                this.dialogEdit = row;
                console.log(index);
                console.log(row);
            },
            // toggleSelection(rows) { //全选 错误的
            //     if (rows) {
            //     rows.forEach(row => {
            //         this.$refs.multipleTable.toggleRowSelection(row);
            //     });
            //     } else {
            //     this.$refs.multipleTable.clearSelection();
            //     }
            // },
            edit() {
               
                this.dialogFormVisible = false;
                // console.log(this.dialogEdit);
                // var formData = this.dialogEdit;
                axios.post('/api/verify', formData).then(res => {
                    console.log(res);
                });
            },
            MessageBox() { //弹框
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
                }).then(() => {
                this.$message({
                    type: 'success',
                    message: '删除成功!'
                });
                }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消删除'
                });          
                });
            },
            //判断请求表单参数
            submitForm(releForms) {
                var releForm = this.ruleForm;
                console.log(releForm);
                //这个方法是判断表单是否成功的
                this.$refs[releForms].validate((valid) => {
                    if (valid) { //如果valid是true
                        console.log('success');
                        console.log(valid);
                    } else { //验证没有通过
                        console.log('error submit!!');
                        return false;
                    }

                    // if(!valid) { //如果验证没有通过
                    //     console.log('error submit!!');
                    //     return false;
                    // }

                    // console.log('success');
                    // console.log(valid);

                });
            }, 
            //重置方法 一定要加ref这个属性
            resetForm(releForm) {
                this.$refs[releForm].resetFields();
            },
            onSubmit() {
                let formData = this.formInline;
                console.log(formData);
                axios.post('api/testValidate', formData).then(res => {
                    consele.log(res.data);
                });
            }
        }
    }
</script>
