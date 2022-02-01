using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Media;
using System.Data.SqlClient;
using System.Linq.Expressions;

namespace Gimpies
{
    public partial class Form2 : Form
    {
        SqlConnection con = new SqlConnection(@"Data Source=(LocalDB)\MSSQLLocalDB;AttachDbFilename=C:\Users\NOOBMASTER69\Documents\dpGimp.mdf;Integrated Security=True;");
        DataSet DS = new System.Data.DataSet();
        SqlCommand cmd;



        public Form2()
        {
            InitializeComponent();

        }

        private void delBtn_Click(object sender, EventArgs e)
        {
        }

        private void listView_ColumnWidthChanging(object sender, ColumnWidthChangingEventArgs e)
        {

        }

        private void Form2_Load(object sender, EventArgs e)
        {
            SoundPlayer sp = new SoundPlayer(@"C:\Users\NOOBMASTER69\source\repos\Student file\Gimpies\Gimpies\media\loginMusic.wav");
            sp.Play();
            btnBuy.Visible = false;
            numericUpDown1.Visible = false;
            
        }



        private void button1_Click(object sender, EventArgs e)
        {
            this.Hide();
            var outlogin = new Form1();
            outlogin.ShowDialog();
            this.Hide();
        }

        private void markCom_SelectedIndexChanged(object sender, EventArgs e)
        {

        }

        private void addBtn_Click(object sender, EventArgs e)
        {
            
            
            if (markCom.Text == "Schoenen" && markCom.Text != "")
            {

               
                dataGridView.DataSource = null;
                dataGridView.Columns.Clear();
                con.Open();
                DataTable dt = new DataTable();
                SqlDataAdapter adapt = new SqlDataAdapter("select DISTINCT Id,Mark,Color,Size,Price,Amount from Product", con);
                adapt.Fill(dt);
                dataGridView.DataSource = dt;
                dataGridView.Columns["Id"].Visible = false;
                dataGridView.Columns["Amount"].Visible = false;

                con.Close();

                foreach (DataGridViewRow row in dataGridView.Rows)
                    
                    if (Convert.ToInt32(row.Cells[5].Value) <= 5)
                    {
                        row.Visible = false;
                    }
                btnBuy.Visible = true;
                numericUpDown1.Visible = true;


                dataGridView.CurrentCell = null;
               // dataGridView.CurrentCell = dataGridView.Rows[0].Cells[1]


            }


            if (markCom.Text == "Jassen" && markCom.Text != "")
            {

                dataGridView.DataSource = null;
                dataGridView.Columns.Add("Mark", "Mark");
                dataGridView.Columns.Add("Color", "Color");
                dataGridView.Columns.Add("Size", "Size");
                dataGridView.Columns.Add("Price", "Price");
                var index = dataGridView.Rows.Add();
                dataGridView.Rows[index].Cells["Mark"].Value = "Coming soon";
                dataGridView.Rows[index].Cells["Color"].Value = "No color detected";
                dataGridView.Rows[index].Cells["Size"].Value = "No size detected";
                dataGridView.Rows[index].Cells["Price"].Value = "Gratis";

                btnBuy.Visible = false;
                numericUpDown1.Visible = false;
            }
            for (int i = 0; i < dataGridView.Columns.Count; i++)
            {
                int col = dataGridView.Columns[i].Width;
                dataGridView.Columns[i].AutoSizeMode = DataGridViewAutoSizeColumnMode.Fill;
                
                dataGridView.Columns[i].Width = col;
            }
           

        }

        private void dataGridView_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
       

        }


        private void colorCom_SelectedIndexChanged(object sender, EventArgs e)
        {

        }

        private void btnBuy_Click(object sender, EventArgs e)
        {
            
            int id = Convert.ToInt32(dataGridView.SelectedRows[0].Cells[0].Value);
            cmd = new SqlCommand("update Product set Amount=@Amount where ID=@id", con);
            if (dataGridView.CurrentCell != null )
            {
            string seletedAmount = dataGridView.CurrentRow.Cells[5].Value.ToString();
            int newAmount = Convert.ToInt32(seletedAmount);
            int aantal = Convert.ToInt32(numericUpDown1.Value);
            int Amount = newAmount - aantal;
            cmd.Parameters.AddWithValue("@Id", id);
            cmd.Parameters.AddWithValue("@Amount", Amount);
            con.Open();
            cmd.ExecuteNonQuery();
            MessageBox.Show(" 'Payment is loading... ");
            MessageBox.Show(" Buy is Succsefull! ");
            con.Close();
          


         
            cmd = new SqlCommand("insert into History(Mark,Color,Size,Price,Amount) values(@Mark,@Color,@Size,@Price,@Amount)", con);
            con.Open();


            string seletedMark = dataGridView.CurrentRow.Cells[1].Value.ToString();
            string seletedColor = dataGridView.CurrentRow.Cells[2].Value.ToString();
            string seletedSize = dataGridView.CurrentRow.Cells[3].Value.ToString();
            string seletedPrice = dataGridView.CurrentRow.Cells[4].Value.ToString();
            int TheSize = Convert.ToInt32(seletedSize);
            int HisAantal = Convert.ToInt32(numericUpDown1.Value);
            cmd.Parameters.AddWithValue("@Mark", seletedMark);
            cmd.Parameters.AddWithValue("@Color", seletedColor);
            cmd.Parameters.AddWithValue("@Size", TheSize);
            cmd.Parameters.AddWithValue("@Price", seletedPrice);
            cmd.Parameters.AddWithValue("@Amount", HisAantal);
            cmd.ExecuteNonQuery();
            con.Close();

            dataGridView.DataSource = null;
            btnBuy.Visible = false;
            numericUpDown1.Visible = false;


            }

            else
            {
                MessageBox.Show("Please select a product!");
            }


        }

        private void btnProf_Click(object sender, EventArgs e)
        {
            
            var prof = new Profile();
            prof.Show();
            

        }

        private void Form2_Closing(object sender, FormClosingEventArgs e)
        {
            if (e.CloseReason == CloseReason.UserClosing)
            {
                if (MessageBox.Show("Are you sure you want to exit ?", "Confirmation",
                MessageBoxButtons.YesNo, MessageBoxIcon.Question) == DialogResult.Yes)
                { Application.Exit(); }
                else { e.Cancel = true; }
            }
        }
    }

}
    
       


