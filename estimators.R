.libPaths(c("C:/Users/bhanu/Documents/R/win-library/3.3","C:/Program Files/R/R-3.3.2/library"))
library(dplyr)
library(cluster)
library(WRS2)
x<-read.csv("limitval.csv",header = FALSE)
y <- x$V1
#args <- commandArgs(TRUE)
#op <- args[1]
#str(op)
#Robost estimators(resistant to outliers) for dirty data
#Winsorized mean
wm <- winmean(y,0.2)
#median high beak even point
me <- median(y)
#huber M-estimator default K=1.28
hm <- mest(y)
#mean lowest break point
m <- mean(y,0.2)
#mad 
val<- cbind(wm,hm,m)
f_val <- round(min(val))
#f_val <- round(hm)
f_val
#plot
png(filename="temp.png", width=500, height=500)

hist(y,col = "ghostwhite",border = "black",prob= TRUE,xlab = "Limit values")
lines(density(y),lwd =2,col="royalblue4")
#plot mean
abline(v = mean(y,0.2),col="green4")
#meadian
abline(v=median(y),col = "red")
#winmean
abline(v = winmean(y,0.1),col = "sienna4" )
#huber m estimator
abline(v = mest(y),col = "slateblue3")

legend(x = "topright",c("Trimmed Mean","Median(L-est)","Winsorized mean","Huber's M-esti"),pch = 1,
       col = c("green4","red","sienna4","slateblue3"),lwd = c(2,2,2,2) )

dev.off()