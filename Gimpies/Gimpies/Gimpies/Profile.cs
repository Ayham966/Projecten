using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;
using System.Data.Common;


namespace Gimpies
{
    public partial class Profile : Form
    {
        SqlConnection con = new SqlConnection(@"Data Source=(LocalDB)\MSSQLLocalDB;AttachDbFilename=C:\Users\NOOBMASTER69\Documents\dpGimp.mdf;Integrated Security=True;");
        DataSet DS = new System.Data.DataSet();
        SqlCommand cmd;

        string check = Form1.EmailCheck;
        public Profile()
        {
            InitializeComponent();
        }

        private void displayUser()
        {
            con.Open();
            
            SqlCommand cmd = new SqlCommand("SELECT Name,Password,Email,Telnumber,Adress,City FROM Users WHERE Email='" + check + "'", con);
           
            cmd.Parameters.AddWithValue("@Email", check);
            email.ReadOnly = true;
            email.BackColor = Color.NavajoWhite;
           
            SqlDataReader dr = cmd.ExecuteReader();

            if (dr.Read() )
            {
                username.Text = dr["Name"].ToString();
                password.Text = dr["Password"].ToString();
                telnumber.Text = dr["Telnumber"].ToString();
                email.Text = dr["Email"].ToString();
                adress.Text = dr["Adress"].ToString();
                city.Text = dr["City"].ToString();
                con.Close();
            }

            else
            {
                cmd.ExecuteNonQuery();
                con.Close();
                return;
            }


        }

        private void checkBox1_CheckedChanged(object sender, EventArgs e)
        {
            if (checkBox1.Checked)
                password.PasswordChar = '\0';
            else
            {
                password.PasswordChar = '*';
            }
        }


        private void telnumber_TextChanged(object sender, EventArgs e)
        {
            if (System.Text.RegularExpressions.Regex.IsMatch(telnumber.Text, "[^0-9]"))
            {
                MessageBox.Show("Please enter only numbers.");
                telnumber.Text = telnumber.Text.Remove(telnumber.Text.Length - 1);
            }
        }

        private void Profile_Load(object sender, EventArgs e)
        {
            displayUser();


        }

        private void button1_Click(object sender, EventArgs e)
        {
            if ( username.Text != "" && password.Text != "" && telnumber.Text != "" && email.Text != "" && adress.Text != "" && city.Text != "")
            {

                cmd = new SqlCommand("update Users set Name=@Name,Password=@Password,Telnumber=@Telnumber,Email=@Email,Adress=@Adress,City=@City where Email=@Email", con);
                con.Open();

               // cmd.Parameters.AddWithValue("@id", id);
                cmd.Parameters.AddWithValue("@Name", username.Text);
                cmd.Parameters.AddWithValue("@Password", password.Text);
                cmd.Parameters.AddWithValue("@Telnumber", telnumber.Text);
                cmd.Parameters.AddWithValue("@Email", email.Text);
                cmd.Parameters.AddWithValue("@Adress", adress.Text);
                cmd.Parameters.AddWithValue("@City", city.Text);
                cmd.ExecuteNonQuery();
                MessageBox.Show("Updated Successfully");
                con.Close();
               
            }
            else
            {
                MessageBox.Show("Please fill all information");
            }

        }

        private void email_TextChanged(object sender, EventArgs e)
        {

        }
    }
}
