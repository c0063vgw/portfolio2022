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
    string str, IT, tmp, file_name = argv[1];
    vector<string> line, sub;    //文字列読み込み用配列

    stringstream path;  //ディレクトリのパスを指定
    path << "../database/data_file/";

    //入出力ファイルを指定
    ifstream in_file1(file_name);
    ofstream out_file1(path.str() + file_name.erase(file_name.find('.')) + ".csv");

    if(!in_file1.is_open()){
        //ファイルオープン時のエラー処理
        cerr << argv[1] << " - ファイルを開けませんでした" << endl;

        return EXIT_FAILURE;
    }else{
        //1行づつ配列に読み込む
        while (getline(in_file1, tmp)){
            if(tmp.find("text") != string::npos
                && tmp.find("class") == string::npos
                && tmp.find("メニュー") == string::npos
                && tmp.find("冷たい") == string::npos
                && tmp.find("その他") == string::npos
                && tmp.find("粉もの") == string::npos
                && tmp.find("焼き物") == string::npos
                && tmp.find("点心") == string::npos)
            {
                tmp = rm_char(tmp, ' ');
                tmp.erase(tmp.size()-1);
                tmp.erase(0, 8);
                if(tmp.find("・") != string::npos){
                    //「・」で分割
                    tmp = Replace_all(tmp, "・", ",--");
                    sub = split(tmp, ",");
                    for(auto it = sub.begin(); it != sub.end(); ++it){
                        line.push_back(rm_char(*it, '-'));
                    }
                }else line.push_back(tmp);
            }
        }
        
    }

    in_file1.close();

    for(auto it = line.begin(); it != line.end(); ++it){
        out_file1 << ++i << "," + *it << endl;
    }

    out_file1.close();

    return 0;
}