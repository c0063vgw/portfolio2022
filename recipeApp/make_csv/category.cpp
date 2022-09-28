#include <iostream>
#include <iomanip>
#include <fstream>
#include <sstream>
#include "removal.h"
/*ヘッダファイル要参照
string, algorithm, vectorインクルード
split関数、rm_bet関数、rm_aro関数、rm_char関数
*/
using namespace std;
using std::cout;    using std::cerr;
using std::endl;    using std::string;

int main(int argc, char *argv[])
{
    int id, key1 = 0, key2 = 0, cnt = 0, i = 0, j = 0, k = 0;
    string str, tmp, file_name = argv[1];
    vector<string> line, l_cate, s_cate;    //文字列読み込み用配列

    stringstream path;  //ディレクトリのパスを指定
    path << "../database/data_file/";

    //入出力ファイルを指定
    ifstream in_file1(file_name);
    ofstream out_file1(path.str() + file_name.erase(file_name.find('.')) + "_l.csv");
    ofstream out_file2(path.str() + file_name + "_s.csv");
    ofstream out_file3(path.str() + "item_tag.csv");


    if(!in_file1.is_open()){
        //ファイルオープン時のエラー処理
        cerr << argv[1] << " - ファイルを開けませんでした" << endl;

        return EXIT_FAILURE;
    }else{
        //1行づつ配列に読み込む
        while (getline(in_file1, str)) line.push_back(str);
        
    }

    in_file1.close();

    auto it = line.begin();
    while (*it++ != "\0")
    {   //textと品を含む行から大カテゴリー名を抽出
        if(line[cnt].find("text") != string::npos && line[cnt].find("品") != string::npos){
            line[cnt] = rm_bet(rm_char(line[cnt], ' '), "(", ")");
            line[cnt].erase(line[cnt].end()-1);
            line[cnt].erase(0, 8);
            l_cate.push_back(line[cnt]);
            //cout << name[j++] << endl;
        }
        //小カテゴリー名と材料名を抽出
        if(line[cnt].find("text") != string::npos && line[cnt].find("品)") == string::npos && line[cnt].find("class") == string::npos){
            line[cnt] = rm_char(line[cnt], ' ');
            line[cnt].erase(line[cnt].end()-1);
            line[cnt].erase(0, 8);
            s_cate.push_back(line[cnt]);
        }
        cnt++;
    }

    for(int n = 0; n < 31; n++){
        s_cate.erase(s_cate.begin());
    }

    for(int n = 1196; n > 917; n--){
        s_cate.pop_back();
    }

    int flag = 0;
    for(auto l = l_cate.begin(); l != l_cate.end(); l){
        string a = *l;
        if(a.find("牛肉") != string::npos) flag = 1;
        if(a.find("酢豚") != string::npos) flag = 0;
        if(flag == 0) out_file1 << ++i << "," << *l++ << endl;
        else *l++;
    }

    out_file1.close();
    ifstream in_file2(path.str() + file_name + "_l.csv");

    if(!in_file2.is_open()){
        //ファイルオープン時のエラー処理
        cerr << argv[1] << " - ファイルを開けませんでした" << endl;

        return EXIT_FAILURE;
    }else{
        //1行づつ配列に読み込む
        line.clear();
        while (getline(in_file2, tmp)) line.push_back(tmp);   
    }

    auto name = l_cate.begin();
    for(it = line.begin(); it != line.end(); it)
    {
        j = 0;
        cout << *name<< ":OK" << endl;
        for(auto s = s_cate.begin(); s != s_cate.end(); s)
        {
            if(j < 459){
                tmp = *s;
                if(tmp.find(*name) != string::npos){
                    id = stoi(*it);
                    out_file2 << ++key1 << "," << *s++ << "," << id << endl;
                    ++j;
                }else {
                    *s++;
                    ++j;
                }
            }else {
                *s++;
                ++j;
            }
        }
        *it++;
        *name++;
    }

    j = 0;
    for(auto s = s_cate.begin(); s != s_cate.end(); s)
    {
        if(j > 458){
            out_file3 << ++key2 << "," << *s++ << endl;
        }else {
            ++j;
            *s++;
        }
    }
    
    out_file2.close();
    out_file3.close();

    return 0;
}